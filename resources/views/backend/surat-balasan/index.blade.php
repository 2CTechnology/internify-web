@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@include('backend.surat-balasan.modal.detail')
@include('backend.surat-balasan.modal.upload')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Nama Ketua</th>
                            <th class="text-center">Tempat Magang</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Surat Balasan</th> {{-- Tambahan --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item?->kelompok?->ketua?->no_identitas ?? '-' }}</td>
                                <td class="text-center">{{ $item?->kelompok?->ketua?->name ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($item->tempatMagang)
                                        {{ strtoupper($item->tempatMagang->nama_tempat) }}
                                    @elseif($item?->tempat_magang)
                                        {{ strtoupper($item->tempat_magang) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->status === 1)
                                        Diterima
                                    @elseif ($item->status === 0)
                                        Mengulang
                                    @else
                                        Belum Ditindaklanjuti
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{-- @if ($item->surat_balasan)
                                        <a href="{{ asset('storage/' . $item->surat_balasan) }}" target="_blank"
                                            class="btn btn-success btn-sm" title="Preview Surat Balasan">
                                            <i class="fa fa-file-pdf-o"></i> Preview
                                        </a>
                                    @else
                                        <span class="text-muted">Belum Ada</span>
                                    @endif --}}
                                    @if ($item->surat_balasan)
                                        {{-- <label for="proposal" class="label-form-control mt-2">Surat Balasan</label> --}}
                                        <div>
                                            <a href="{{ asset($item->surat_balasan) }}" target="_blank"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-download"></i> Download balasan
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center d-flex justify-content-center">
                                    <a href="#">
                                        <button data-toggle="modal" data-target="#exampleModal{{ $item->id }}"
                                            data-prodi="{{ $item->prodi->nama_prodi ?? '-' }}"
                                            data-golongan="{{ $item->golongan }}" data-email="{{ $item->email }}"
                                            data-angkatan="{{ $item->angkatan }}" type="button" id="PopoverCustomT-1"
                                            class="btn btn-warning btn-md btn-show-modal" data-toggle="tooltip"
                                            title="Detail" data-placement="top"><span class="fa fa-eye"></span></button>
                                    </a>
                                    <a href="#" class="mx-2">
                                        <button data-toggle="modal" data-target="#modalUpload" type="button"
                                            id="PopoverCustomT-1" class="btn btn-primary btn-md btn-upload"
                                            data-id="{{ $item->id }}" data-status="{{ $item->status }}"
                                            data-toggle="tooltip" title="Tindak Lanjut" data-placement="top"><span
                                                class="fa fa-pen"></span></button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak Ada Data Tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $(".btn-show-modal").on('click', function() {
            var angkatan = $(this).data('angkatan');
            var golongan = $(this).data('golongan');
            var prodi = $(this).data('prodi');
            var email = $(this).data('email');
            console.log(angkatan);

            $("#angkatan-modal").val(angkatan);
            $("#golongan-modal").val(golongan);
            $("#prodi-modal").val(prodi);
            $("#email-modal").val(email);
        })

        // ketika tombol "Tindak Lanjut" diklik
        $(document).on('click', '.btn-upload', function() {
            var id = $(this).data('id');
            var status = $(this).data('status'); // 1 atau 0

            // isi hidden input id
            $('#hidden-id-status').val(id);

            // preset dropdown status (konversi angka → string)
            if (status === 1 || status === '1') {
                $('#select-status').val('diterima');
            } else if (status === 0 || status === '0') {
                $('#select-status').val('mengulang');
            } else {
                $('#select-status').val('');
            }
        });


        $(".btn-tolak").on('click', function() {
            var id = $(this).data('id')
            console.log(`dec: ${id}`);
            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda Yakin Menolak Akun Ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#decline-${id}`).submit()
                }
            });
        })

        $(document).ready(function() {
            $('#table').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });
        });
    </script>
@endpush
