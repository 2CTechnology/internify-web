@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@push('add-button')
    <a href="{{ route('bimbingan.create') }}">
        <button class="btn btn-success">Tambah Jadwal Bimbingan</button>
    </a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table" class="table align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Tanggal</th>
                            {{-- <th class="text-center">Catatan</th> --}}
                            <th class="text-center">Nama Kelompok</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($item->jadwal)->format('d M Y') }}
                                </td>
                                {{-- <td>{{ $item->catatan ?? '-' }}</td> --}}
                                <td class="text-center">
                                    {{ $item->kelompok->nama_kelompok ?? '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $item->kelompok->nama_kelompok ?? '-' }}
                                </td>
                                <td class="text-center d-flex justify-content-center">
                                    {{-- <div class="form-inline text-center"> --}}
                                        <a href="#">
                                            <button data-toggle="modal" data-target="#exampleModal{{ $item->id }}" data-prodi="{{ $item->prodi->nama_prodi ?? '-' }}" data-golongan="{{ $item->golongan }}" data-email="{{ $item->email }}" data-angkatan="{{ $item->angkatan }}" type="button" id="PopoverCustomT-1" class="btn btn-warning btn-md btn-show-modal" data-toggle="tooltip" title="Detail" data-placement="top"><span class="fa fa-eye"></span></button>    
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
                                <td colspan="5" class="text-center">Tidak ada data.</td>
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
        $(document).ready(function () {
            $('#table').DataTable({
                columnDefs: [{
                    defaultContent: '-',
                    targets: '_all'
                }]
            });
        });
    </script>
@endpush