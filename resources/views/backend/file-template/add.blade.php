@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('file-template.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_template" class="label-form-control">Nama Template</label>
                    <input type="text" class="form-control @error('nama_template') is-invalid @enderror" name="nama_template" value="{{ old('nama_template') }}">
                    @error('nama_template')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="file_template" class="label-form-control">File Template</label>
                    <input type="file" class="form-control @error('file_template') is-invalid @enderror" name="file_template" value="{{ old('file_template') }}">
                    @error('file_template')
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