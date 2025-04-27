@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">Nama Ketua</td>
                            <td class="text-center d-flex justify-content-center">

                                <a href="#" class="mx-2">
                                    <button type="button" class="btn btn-success btn-md" title="Simpan"
                                        data-toggle="tooltip" data-placement="top">
                                        <span class="fa fa-save"></span>
                                    </button>
                                </a>
                                <a href="#">
                                    <button type="button" class="btn btn-warning btn-md" title="Detail"
                                        data-toggle="tooltip" data-placement="top">
                                        <span class="fa fa-eye"></span>
                                    </button>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">Tidak Ada Data Tersedia.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection