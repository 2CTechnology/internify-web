@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@push('add-button')
    <a href="{{ route('faq.create') }}">
        <button class="btn btn-success">Tambah</button>
    </a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Pertanyaan</th>
                            <th class="text-center">Jawaban</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->pertanyaan }}</td>
                                <td class="text-center">{{ $item->jawaban }}</td>
                                <td class="text-center d-flex justify-content-center">
                                    {{-- <div class="form-inline text-center"> --}}
                                        <a href="{{ route('faq.edit', $item->id) }}" class="mx-2">
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md" data-toggle="tooltip" title="Edit" data-placement="top"><span class="fa fa-pen"></span></button>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-md btn-hapus" data-id="{{ $item->id }}" data-toggle="tooltip" title="Hapus" data-placement="top">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                        <form action="{{ route('faq.destroy', $item->id) }}" method="post" id="hapus-{{ $item->id }}">
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
        $(".btn-hapus").on("click", function(){
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