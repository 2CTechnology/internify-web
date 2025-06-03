@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@push('add-button')
    <a href="{{ route('dospem.create') }}">
        <button class="btn btn-success">Tambah</button>
    </a>
@endpush

@include('backend.dospem.modal.detail')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">NIDN</th>
                            <th class="text-center">Nama Dosen</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->no_identitas }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center d-flex justify-content-center">
                                    {{-- <div class="form-inline text-center"> --}}
                                    <a href="#">
                                        <button data-toggle="modal" data-target="#exampleModal"
                                            data-foto="{{ asset($item->foto) }}" data-no_telp="{{ $item->no_telp }}"
                                            data-email="{{ $item->email }}" type="button" id="PopoverCustomT-1"
                                            class="btn btn-warning btn-md btn-show-modal" data-toggle="tooltip"
                                            title="Detail" data-placement="top"><span class="fa fa-eye"></span></button>
                                    </a>
                                    <a href="{{ route('dospem.edit', $item->id) }}" class="mx-2">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md"
                                            data-toggle="tooltip" title="Edit" data-placement="top"><span
                                                class="fa fa-pen"></span></button>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-md btn-hapus"
                                        data-id="{{ $item->id }}" data-toggle="tooltip" title="Hapus"
                                        data-placement="top">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                    <form action="{{ route('dospem.destroy', $item->id) }}" method="post"
                                        id="hapus-{{ $item->id }}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    {{-- </div> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak Ada Data Tersedia.</td>
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
            var foto = $(this).data('foto');
            var email = $(this).data('email');
            var no_telp = $(this).data('no_telp');
            console.log(foto);

            $("#foto-modal").attr('src', foto);
            $("#email-modal").val(email);
            $("#no_telp-modal").val(no_telp);
        })

        $(".btn-hapus").on("click", function() {
            var id = $(this).data('id')
            console.log(`dec: ${id}`);
            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda Yakin Menghapus Data Ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#hapus-${id}`).submit()
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