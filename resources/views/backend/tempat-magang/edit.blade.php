@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('tempat-magang.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_tempat" class="label-form-control">Nama Tempat</label>
                    <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror" name="nama_tempat" value="{{ old('nama_tempat', $data->nama_tempat) }}">
                    @error('nama_tempat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="alamat" class="label-form-control">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat', $data->alamat) }}">
                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="deskripsi_pekerjaan" class="label-form-control">Deskripsi Pekerjaan</label>
                    <textarea name="deskripsi_pekerjaan" id="" cols="" rows="" class="form-control">{{ old('deskripsi_pekerjaan', $data->deskripsi_pekerjaan) }}</textarea>
                    @error('deskripsi_pekerjaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="deskripsi_perusahaan" class="label-form-control">Deskripsi Perusahaan</label>
                    <textarea name="deskripsi_perusahaan" id="" cols="" rows="" class="form-control">{{ old('deskripsi_perusahaan', $data->deskripsi_perusahaan) }}</textarea>
                    @error('deskripsi_perusahaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="website" class="label-form-control">Alamat Website</label>
                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website', $data->website) }}">
                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="employee_size" class="label-form-control">Jumlah Karyawan</label>
                    <input type="text" class="form-control @error('employee_size') is-invalid @enderror" name="employee_size" value="{{ old('employee_size', $data->employee_size) }}">
                    @error('employee_size')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="head_office" class="label-form-control">Head Office</label>
                    <input type="text" class="form-control @error('head_office') is-invalid @enderror" name="head_office" value="{{ old('head_office', $data->head_office) }}">
                    @error('head_office')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="since" class="label-form-control">Berdiri Sejak</label>
                    <input type="text" class="form-control @error('since') is-invalid @enderror" name="since" value="{{ old('since', $data->since) }}">
                    @error('since')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="specialization" class="label-form-control">Spesialisasi</label>
                    <input type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{ old('specialization', $data->specialization) }}">
                    @error('specialization')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="kriteria" class="label-form-control">Kriteria</label>
                    <input type="text" class="form-control @error('kriteria') is-invalid @enderror" name="kriteria" value="{{ old('kriteria', $data->kriteria) }}">
                    @error('kriteria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label for="posisi" class="label-form-control">Posisi</label>
                    <input type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi" value="{{ old('posisi', $data->posisi) }}">
                    @error('posisi')
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