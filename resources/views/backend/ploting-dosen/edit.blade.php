@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <form action="{{ route('ploting-dosen.ploting-dosen.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <label for="id_dosen" class="label-form-control">Dosen</label>
                <select name="id_dosen" id="id_dosen" class="select2 form-control @error('id_dosen') is-invalid @enderror">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach ($listDosen as $item)
                        <option value="{{ $item->id }}" @selected($item->id == $data->id_dosen)>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('id_dosen')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="jawaban" class="label-form-control">Kota</label>
                    <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ old('kota', $data->kota) }}">
                    @error('kota')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="jawaban" class="label-form-control">Tahun</label>
                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun', $data->tahun) }}">
                    @error('tahun')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="jawaban" class="label-form-control">Jumlah Kelompok</label>
                    <input type="number" class="form-control @error('jumlah_kelompok') is-invalid @enderror" name="jumlah_kelompok" value="{{ old('jumlah_kelompok', $data->jumlah_kelompok) }}">
                    @error('jumlah_kelompok')
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