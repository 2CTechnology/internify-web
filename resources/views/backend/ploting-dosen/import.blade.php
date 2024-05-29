@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('ploting-dosen.store-import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" name="id_dosen" id="id_dosen">
            <input type="hidden" name="kota" id="kota">
            <input type="hidden" name="tahun" id="tahun">
            <input type="hidden" name="jumlah_kelompok" id="jumlah_kelompok">
            <div class="col-md-6">
                <input type="file" class="form-control" name="excel" id="file-excel">
            </div>
            <div class="col-md-6">
                <button class="btn btn-success" type="button" id="filter">
                    Cek
                </button>
            </div>
            
            <div id="hasil-filter" class="col-md-12 mt-3 hidden">
                <div class="table-responsive">
                    <table class="table" id="table_item">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">NIDN</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kota</th>
                                <th class="text-center">Tahun</th>
                            </tr>
                        </thead>
                        <tbody id="t_body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('card-footer')
    <div class="card-footer">
        <button class="btn btn-primary hidden" id="btn-submit">Simpan</button>
    </div>
@endsection

@push('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#btn-submit").on('click', function() {
            $("form").submit()
        })

        $("#filter").on('click', function() {
            importExcel()

            $('#btn-submit').addClass('hidden');
            $('#hasil-filter').addClass('hidden');
            $('#table_item tbody').empty();
        })

        function importExcel() {
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;
            var test = $("#file-excel").val();
            var sheet_data = [];
            if (regex.test($("#file-excel").val().toLowerCase())) {
                var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/
                if ($('#file-excel').val().toLowerCase().indexOf(".xlsx") > 0) {
                    xlsxflag = true;
                }
                // check browser support html5
                if (typeof(FileReader) != 'undefined') {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var data = e.target.result;
                        // convert the excel data in to object
                        if (xlsxflag) {
                            var workbook = XLSX.read(data, {type: 'binary'});
                        }
                        // all element sheetnames of excel
                        var sheet_name_list = workbook.SheetNames;
                        if (typeof(sheet_name_list) != 'undefined') {
                            sheet_data = XLSX.utils.sheet_to_json(workbook.Sheets[sheet_name_list[0]], {header:2});
                            showTable(sheet_data);
                        }
                    }

                    reader.onerror = function(ex) {
                        console.log(ex);
                    };
                    if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/
                        reader.readAsArrayBuffer($("#file-excel")[0].files[0]);
                    }
                    else {
                        reader.readAsBinaryString($("#file-excel")[0].files[0]);
                    }
                } else {
                    console.log('tidak support');
                }
            } else {
                alert("Unggah file Excel yang valid!");
                $('#table_item tbody').empty();
                $('#hasil-filter').addClass('hidden');
                $('#cover-btn-simpan').addClass('hidden');
            }
        }

        function showTable(sheet_data) {
            var dataIdDosen = [];
            var dataKota = [];
            var dataTahun = [];
            var dataJumlahKelompok = [];
            var dataNidn = [];

            var cekNidn = [];
            var idRequest = [];
            var hasError = false;

            var no = 0;

            $.each(sheet_data,function(key, value) {
                if (sheet_data[key].hasOwnProperty('NIDN') && sheet_data[key].hasOwnProperty('Kota') && sheet_data[key].hasOwnProperty('Tahun') && sheet_data[key].hasOwnProperty('Jumlah_Kelompok')) {
                    // console.log(value['Nominal'].replace(/[ ,.Rprp]/g, ""));
                    dataNidn.push({ no_identitas: value['NIDN'], row: key +1 });
                    dataKota.push(value['Kota']);
                    dataTahun.push(value['Tahun']);
                    dataJumlahKelompok.push(value['Jumlah_Kelompok']);
                }
            })
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                type: "POST",
                url: `{{ url('ploting-dosen/get-dosen-by-nidn') }}`,
                data: {
                    no_identitas: JSON.stringify(dataNidn),
                },
                success: function(res){
                    var new_body_tr = ``;
                    var new_body_tr_success = ``;
                    var message = ``;
                    var tittleMessage = ``;
                    var headerMessage = `harap cek kembali pada file excel yang di upload.`;
                    $.each(res,function(key,value) {
                        if(value.cek_nidn == false) {
                            hasError = true;
                            no++;
                            new_body_tr += `
                                <tr class="table-danger">
                                    <td class="text-center">
                                        ${no}
                                    </td>
                                    <td class="text-center">
                                        ${value.no_identitas}
                                    </td>
                                    <td class="text-center">
                                        ${value.nama}
                                    </td>
                                    <td class="text-center">
                                        ${dataKota[key] == undefined ? '-' : dataKota[key]}
                                    </td>
                                    <td class="text-center">
                                        ${dataTahun[key] == undefined ? '-' : dataTahun[key]}
                                    </td>
                                </tr>
                            `;
                        } else {
                            hasError = false;
                            idRequest.push(value.id_dosen);
                            no++;
                            new_body_tr += `
                                <tr class="">
                                    <td class="text-center">
                                        ${no}
                                    </td>
                                    <td class="text-center">
                                        ${value.no_identitas}
                                    </td>
                                    <td class="text-center">
                                        ${value.nama}
                                    </td>
                                    <td class="text-center">
                                        ${dataKota[key] == undefined ? '-' : dataKota[key]}
                                    </td>
                                    <td class="text-center">
                                        ${dataTahun[key] == undefined ? '-' : dataTahun[key]}
                                    </td>
                                </tr>
                            `;
                        }
                    })
                    if(hasError == true) {
                        Swal.fire({
                            title: 'Terjadi kesalahan!',
                            text: 'Terdapat NIDN yang tidak ditemukan.',
                            icon: 'error'
                        });
                        
                        $('#btn-submit').addClass('hidden');
                        $('#hasil-filter').removeClass('hidden');
                        $('#table_item tbody').append(new_body_tr);
                    } else {
                        console.log(idRequest);
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Valid.',
                            icon: 'success'
                        });

                        $("#id_dosen").val(idRequest);
                        $("#kota").val(dataKota);
                        $("#tahun").val(dataTahun);
                        $("#jumlah_kelompok").val(dataJumlahKelompok)

                        $('#table_item tbody').append(new_body_tr);
                        $('#btn-submit').removeClass('hidden');
                        $('#hasil-filter').removeClass('hidden');
                    }
                }
            })
        }
    </script>
@endpush