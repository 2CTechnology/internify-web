@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@include('backend.surat-pelaksanaan.modal.detail')
@include('backend.surat-pelaksanaan.modal.update')

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
                            <th class="text-center">Surat Balasan</th>
                            <th class="text-center">Surat Pelaksanaan</th>
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
                                {{-- <td class="text-center">
                                    @if ($item->status === 1)
                                        Diterima
                                    @elseif ($item->status === 0)
                                        Mengulang
                                    @else
                                        Belum Ditindaklanjuti
                                    @endif
                                </td> --}}
                                <td class="text-center">{{ ucwords($item->status_surat_balasan) }}</td>

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
                                <td class="text-center">
                                    @if ($item->surat_pengantar == 'surat pelaksanaan telah dibuat')
                                        <span class="badge badge-success">Sudah Dibuat</span>
                                    @else
                                        <span class="badge badge-secondary">Belum</span>
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
                                    @if ($item->is_accepted == 0)
                                        <a href="#" class="mx-2">
                                            <button data-toggle="modal" data-target="#modalUpload"
                                                class="btn btn-primary btn-md btn-konfirm" data-id="{{ $item->id }}"
                                                data-status="{{ $item->status }}" title="Ubah Status">
                                                <span class="fa fa-pen"></span>
                                            </button>
                                        </a>
                                    @endif

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
        $('body').on('click', '.btn-konfirm', function() {
            const id = $(this).data('id');
            $('#id-upload').val(id);
        });


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
