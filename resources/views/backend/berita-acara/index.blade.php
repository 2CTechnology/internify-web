@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10"> {{-- Perbesar card untuk tampilan lebih luas --}}
                <div class="card shadow-lg border-0 rounded-4"> {{-- Tambahkan shadow dan rounded corner --}}
                    <div class="card-header bg-primary text-white rounded-top-4">
                    </div>
                    <div class="card-body p-4">

                        <form action="{{ route('berita-acara.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="tanggal" class="form-label">Tanggal Acara</label>
                                <input type="date"
                                    class="form-control form-control-lg @error('jadwal') is-invalid @enderror" id="tanggal"
                                    name="jadwal" value="{{ old('jadwal') }}" required>
                                @error('jadwal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="tempat_magang_id" class="form-label">Tempat Magang</label>
                                <select class="form-control form-control-lg @error('tempat_magang_id') is-invalid @enderror"
                                    id="tempat_magang_id" name="tempat_magang_id" required>
                                    <option value="">-- Pilih Tempat Magang --</option>
                                    @foreach($tempat_magangs as $tempat)
                                        <option value="{{ $tempat->id }}" {{ old('tempat_magang_id') == $tempat->id ? 'selected' : '' }}>
                                            {{ $tempat->nama_tempat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tempat_magang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="prodi" class="form-label">Prodi</label>
                                <select class="form-control form-control-lg @error('prodi') is-invalid @enderror"
                                    id="prodi" name="prodi" required>
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach($mst_prodi as $prodi)
                                        <option value="{{ $prodi->nama_prodi }}" 
                                            {{ old('prodi') == $prodi->nama_prodi ? 'selected' : '' }}>
                                            {{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select class="form-control form-control-lg @error('jurusan') is-invalid @enderror"
                                    id="jurusan" name="jurusan" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach($mst_prodi as $prodi)
                                        <option value="{{ $prodi->jurusan }}" 
                                            {{ old('jurusan') == $prodi->jurusan ? 'selected' : '' }}>
                                            {{ $prodi->jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="alamat" class="form-label">Alamat Magang</label>
                                <select class="form-control form-control-lg @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" required>
                                    <option value="">-- Pilih Alamat Magang --</option>
                                    @foreach($tempat_magangs as $tempat)
                                        <option value="{{ $tempat->alamat }}" 
                                            {{ old('alamat') == $tempat->alamat ? 'selected' : '' }}>
                                            {{ $tempat->alamat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="keterangan" class="form-label">Catatan Berita</label>
                                <textarea class="form-control form-control-lg @error('keterangan') is-invalid @enderror" 
                                    id="keterangan" name="keterangan" rows="6" placeholder="Isi catatan berita..." required>{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-lg">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-3">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
