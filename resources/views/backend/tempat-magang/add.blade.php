@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('tempat-magang.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_tempat" class="label-form-control">Nama Tempat</label>
                    <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror" name="nama_tempat" value="{{ old('nama_tempat') }}">
                    @error('nama_tempat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="daerah" class="label-form-control">Daerah</label>
                    <input type="text" class="form-control @error('daerah') is-invalid @enderror" name="daerah" value="{{ old('daerah') }}">
                    @error('daerah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </form>
@endsection

@section('card-footer')
    <div class="card-footer">
        <button class="btn btn-primary" id="btn-submit">Simpan</button>
    </div>
@endsection

@push('custom-script')
    <script>
        $("#btn-submit").on('click', function() {
            $("form").submit()
        })
    </script>
@endpush