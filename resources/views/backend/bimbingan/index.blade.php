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
                            <th class="text-center">Catatan</th>
                            <th class="text-center">Nama Kelompok</th>
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
                                <td>{{ $item->catatan ?? '-' }}</td>
                                <td class="text-center">
                                    {{ $item->kelompok->nama_kelompok ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="#" class="btn btn-sm btn-success">Done</a>
                                    {{-- Tambahan opsi lain jika diperlukan --}}
                                    {{-- <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form> --}}
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