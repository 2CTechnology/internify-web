@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@include('backend.laporan-magang.modal.tindak-lanjut')
@include('backend.laporan-magang.modal.detail')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Kelompok</th>
                            <th class="text-center">Status Laporan</th>
                            <th class="text-center">File Laporan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->kelompok->nama_kelompok ?? '-' }}</td>
                                <td class="text-center">{{ ucwords($item->status_laporan) }}</td>
                                <td class="text-center">
                                    @if ($item->laporan)
                                        <a href="{{ asset($item->laporan) }}" target="_blank" class="mx-2"
                                            data-toggle="tooltip" title="Download Laporan" data-placement="top">
                                            <button type="button" class="btn btn-success btn-md">
                                                <span class="fa fa-download"></span>
                                            </button>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center d-flex justify-content-center">
                                    <!-- Detail Modal -->
                                    <a href="#" data-toggle="modal" data-target="#modalDetail{{ $item->id }}">
                                        <button type="button" class="btn btn-warning btn-md" data-toggle="tooltip"
                                            title="Detail" data-placement="top">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                    </a>

                                    <!-- Tindak Lanjut -->
                                    <a href="#" class="mx-2" data-toggle="modal" data-target="#modalTindakLanjut">
                                        <button type="button" class="btn btn-primary btn-md btn-konfirm"
                                            data-id="{{ $item->id }}" data-toggle="tooltip" title="Tindak Lanjut"
                                            data-placement="top">
                                            <span class="fa fa-pen"></span>
                                        </button>
                                    </a>

                                    <!-- Hapus -->
                                    <a href="#" class="btn-tolak" data-id="{{ $item->id }}">
                                        <button type="button" class="btn btn-danger btn-md" data-toggle="tooltip"
                                            title="Hapus" data-placement="top">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </a>

                                    <!-- Form Hapus -->
                                    <form action="{{ route('laporan-magang.destroy', $item->id) }}" method="post"
                                        id="decline-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak Ada Data Tersedia.</td>
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
        $(document).ready(function() {
            $('#table').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });

            // Set ID untuk modal tindak lanjut
            $(".btn-konfirm").on('click', function() {
                var id = $(this).data('id');
                $("#id-tindak-lanjut").val(id);
            });

            // Opsi kondisi saat ganti tindak lanjut
            $("#tindak_lanjut").change(function() {
    var value = $(this).val();
    if (value === 'revisi') {
        $("#revisi-label, #revisi").removeClass('d-none');
    } else {
        $("#revisi-label, #revisi").addClass('d-none');
    }
});


            // Konfirmasi hapus
            $(".btn-tolak").on('click', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: "Konfirmasi",
                    text: "Apakah Anda yakin ingin menghapus laporan magang ini secara permanen?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#decline-${id}`).submit();
                    }
                });
            });
        });
    </script>
@endpush
