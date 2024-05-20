@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('file-template.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_template" class="label-form-control">Nama Template</label>
                    <input type="text" class="form-control @error('nama_template') is-invalid @enderror" name="nama_template" value="{{ old('nama_template', $data->nama_file) }}">
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
                    <div class="input-group">
                        <label class="btn btn-outline-secondary" for="file" type="button" id="button-addon1">Upload</label>
                        <input type="file" class="form-control" name="file_template" placeholder="Kebutuhan Sertifikat" id="file" style="display: none;">
                        @php
                            $showFile = '';
                            if ($data->file) {
                                $fileName = explode('/', $data->file);
                                $showFile = end($fileName);
                            }
                        @endphp
                        <input type="text" title="{{ $showFile }}" class="form-control custom-file-label" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled value="{{ $showFile }}">
                    </div>
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
        $('#file').change(function() {
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