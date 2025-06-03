@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('dospem.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="label-form-control">Nama Dosen</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="label-form-control">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nidn" class="label-form-control">NIDN</label>
                    <input type="text" class="form-control @error('nidn') is-invalid @enderror" name="nidn" value="{{ old('nidn') }}">
                    @error('nidn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
    <div class="form-group">
        <label for="password" class="label-form-control">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="foto" class="label-form-control">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}">
                    @error('foto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_telp" class="label-form-control">No. Telp</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}">
                    @error('no_telp')
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