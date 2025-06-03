@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('dospem.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="label-form-control">Nama Dosen</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $data->name) }}">
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
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $data->email) }}">
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
                    <input type="text" class="form-control @error('nidn') is-invalid @enderror" name="nidn" value="{{ old('nidn', $data->no_identitas) }}">
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
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
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
                    <div class="input-group">
                        <label class="btn btn-outline-secondary" for="foto" type="button" id="button-addon1">Upload</label>
                        @php
                            $showFile = '';
                            if ($data->foto) {
                                $fileName = explode('/', $data->foto);
                                $showFile = end($fileName);
                            }
                        @endphp
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" id="foto" style="display: none;">
                        <input type="text" title="{{ $showFile }}" class="form-control custom-file-label" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled value="{{ $showFile }}">
                    </div>
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
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $data->no_telp) }}">
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
        $('#foto').change(function() {
            // var i = $(this).prev('label').clone();
            // var file = $('#file')[0].files[0].name;
            // $(this).prev('label').text(file);

            //get the file name
            var fileName = $(this).val();
            console.log($(this).next('.custom-file-label'));
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').val(fileName);
        });
    </script>
@endpush