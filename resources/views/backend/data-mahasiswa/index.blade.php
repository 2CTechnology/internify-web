@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@include('backend.data-mahasiswa.modal.detail')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Prodi</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tempat Magang</th>
                            <th class="text-center">Kota</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->kelompok->ketua->no_identitas ?? '-' }}</td>
                                <td class="text-center">{{ $item->kelompok->ketua->prodi->nama_prodi ?? '-' }}</td>
                                <td class="text-center">{{ $item->kelompok->ketua->name ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($item->tempatMagang)
                                        {{ strtoupper($item->tempatMagang->nama_tempat) }}
                                    @elseif($item->tempat_magang)
                                        {{ strtoupper($item->tempat_magang) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->tempatMagang->kota ?? '-' }}</td>
                                <td class="text-center">{{ ucwords($item->status_surat_balasan ?? '-') }}</td>
                                <td class="text-center d-flex justify-content-center">
                                    <a href="#">
    <button 
        data-toggle="modal" 
        data-target="#exampleModal{{ $item->id }}" 
        data-prodi="{{ $item->prodi->nama_prodi ?? '-' }}" 
        data-golongan="{{ $item->golongan }}" 
        data-email="{{ $item->email }}" 
        data-angkatan="{{ $item->angkatan }}" 
        type="button" 
        class="btn btn-warning btn-md btn-show-modal" 
        title="Detail"
    >
        <span class="fa fa-eye"></span>
    </button>    
</a>



                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak Ada Data Tersedia.</td>
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
                    targets: '_all',
                    defaultContent: '-'
                }]
            });

            $(document).on('click', '.btn-show-modal', function() {
                var angkatan = $(this).data('angkatan');
                var golongan = $(this).data('golongan');
                var prodi = $(this).data('prodi');
                var email = $(this).data('email');
                console.log(angkatan);

                $("#angkatan-modal").val(angkatan);
                $("#golongan-modal").val(golongan);
                $("#prodi-modal").val(prodi);
                $("#email-modal").val(email);
            });
        });
    </script>
@endpush
