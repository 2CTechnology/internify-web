@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@push('add-button')
    <a href="{{ route('ploting-dosen.ploting-dosen.create') }}">
        <button class="btn btn-success">Tambah</button>
    </a>
    <a href="{{ route('ploting-dosen.import') }}">
        <button class="btn btn-secondary">Import</button>
    </a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">NIDN</th>
                            <th class="text-center">Nama Dosen</th>
                            <th class="text-center">Kota</th>
                            <th class="text-center">Jumlah Kelompok</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item?->dosen?->no_identitas }}</td>
                                <td class="text-center">{{ $item->dosen?->name }}</td>
                                <td class="text-center">{{ $item->kota }}</td>
                                <td class="text-center">{{ $item->jumlah_kelompok }}</td>
                                <td class="text-center">{{ $item->status ? 'Aktif' : 'Nonaktif' }}</td>
                                <td class="text-center d-flex justify-content-center">
                                    <a href="{{ route('ploting-dosen.ploting-dosen.edit', $item->id) }}" class="mx-2">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md" data-toggle="tooltip" title="Edit" data-placement="top"><span class="fa fa-pen"></span></button>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-md btn-hapus" data-id="{{ $item->id }}" data-toggle="tooltip" title="Nonaktifkan" data-placement="top">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                    <form action="{{ route('ploting-dosen.ploting-dosen.destroy', $item->id) }}" method="post" id="hapus-{{ $item->id }}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak Ada Data Tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('custom-sript')
    <script>
        $(".btn-hapus").on("click", function(){
            var id = $(this).data('id')
            console.log(`dec: ${id}`);
            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda Yakin Menonaktifkan Data Ini?",
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
    </script>
@endpush