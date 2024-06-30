@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@include('backend.proposal.modal.detail')
@include('backend.proposal.modal.tindak-lanjut')

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
                                <td class="text-center">{{ ucwords($item->status_proposal) }}</td>
                                <td class="text-center d-flex justify-content-center">
                                    {{-- <div class="form-inline text-center"> --}}
                                        <a href="#">
                                            <button data-toggle="modal" data-target="#exampleModal{{ $item->id }}" data-prodi="{{ $item->prodi->nama_prodi ?? '-' }}" data-golongan="{{ $item->golongan }}" data-email="{{ $item->email }}" data-angkatan="{{ $item->angkatan }}" type="button" id="PopoverCustomT-1" class="btn btn-warning btn-md btn-show-modal" data-toggle="tooltip" title="Detail" data-placement="top"><span class="fa fa-eye"></span></button>    
                                        </a>
                                        <a href="{{ route('download.proposal', $item->id) }}" class="ml-2" download>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-secondary btn-md" data-toggle="tooltip" title="Download" data-placement="top"><span class="fa fa-download"></span></button>    
                                        </a>
                                        @if ($item->is_accepted == 0)
                                            <a href="#" class="mx-2">
                                                <button data-toggle="modal" data-target="#modalTindakLanjut" type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md btn-konfirm" data-id="{{ $item->id }}" data-toggle="tooltip" title="Tindak Lanjut" data-placement="top"><span class="fa fa-pen"></span></button>
                                            </a>
                                        @endif
                                        @if ($item->is_accepted == 0)
                                            <a href="#">
                                                <button type="button" class="btn btn-danger btn-md btn-tolak" data-toggle="tooltip" title="Tolak" data-placement="top" data-id="{{ $item->id }}">
                                                    <span class="fa fa-trash"></span>
                                                </button>
                                            </a>
                                            <form action="{{ route('akun-mahasiswa.destroy', $item->id) }}" method="post" id="decline-{{ $item->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @endif
                                    {{-- </div> --}}
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

        $(".btn-konfirm").on('click', function () {
            var id = $(this).data('id')
            $("#id-tindak-lanjut").val(id)
        })

        $("#tindak_lanjut").change(function() {
            var value = $(this).val();
            if(value == 'revisi') {
                $("#revisi-label").removeClass('d-none')
                $("#revisi").removeClass('d-none')
                $("#alasan_ditolak-label").addClass('d-none')
                $("#alasan_ditolak").addClass('d-none')
            } else if(value == 'ditolak') {
                $("#alasan_ditolak-label").removeClass('d-none')
                $("#alasan_ditolak").removeClass('d-none')
                $("#revisi-label").addClass('d-none')
                $("#revisi").addClass('d-none')
            } else {
                $("#revisi-label").addClass('d-none')
                $("#revisi").addClass('d-none')
                $("#alasan_ditolak-label").addClass('d-none')
                $("#alasan_ditolak").addClass('d-none')
            }
        })

        $(".btn-tolak").on('click', function () {
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

        $(document).ready( function () {
            $('#table').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });
        });
    </script>
@endpush