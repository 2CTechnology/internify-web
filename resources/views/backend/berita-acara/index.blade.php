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
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        {{-- Header opsional --}}
                    </div>

                    <div class="card-body p-4">
                        {{-- Notifikasi sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('berita-acara.store') }}" method="POST">
                            @csrf

                            {{-- Tanggal Acara --}}
                            <div class="form-group mb-4">
                                <label for="tanggal" class="form-label">Tanggal Acara</label>
                                <input type="date"
                                    class="form-control form-control-lg @error('jadwal') is-invalid @enderror"
                                    id="tanggal" name="jadwal" value="{{ old('jadwal') }}" required>
                                @error('jadwal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kelompok --}}
                            <div class="form-group mb-4">
                                <label for="kelompok_id" class="form-label">Kelompok</label>
                                <select name="kelompok_id" id="kelompok_id"
                                    class="form-control form-control-lg @error('kelompok_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Kelompok --</option>
                                    @foreach($kelompoks as $kelompok)
                                        <option value="{{ $kelompok->id }}"
                                            {{ old('kelompok_id') == $kelompok->id ? 'selected' : '' }}>
                                            {{ $kelompok->nama_kelompok }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelompok_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tempat Magang --}}
                            <div class="form-group mb-4">
                                <label for="tempat_magang_id" class="form-label">Tempat Magang</label>
                                <select id="tempat_magang_id" name="tempat_magang_id"
                                    class="form-control form-control-lg @error('tempat_magang_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Tempat Magang --</option>
                                    @foreach($tempat_magangs as $tempat)
                                        <option value="{{ $tempat->id }}"
                                            {{ old('tempat_magang_id') == $tempat->id ? 'selected' : '' }}>
                                            {{ $tempat->nama_tempat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tempat_magang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Prodi --}}
                            <div class="form-group mb-4">
                                <label for="prodi" class="form-label">Prodi</label>
                                <select id="prodi" name="prodi"
                                    class="form-control form-control-lg @error('prodi') is-invalid @enderror" required>
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

                            {{-- Jurusan --}}
                            <div class="form-group mb-4">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select id="jurusan" name="jurusan"
                                    class="form-control form-control-lg @error('jurusan') is-invalid @enderror"
                                    required>
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

                            {{-- Alamat Magang --}}
                            <div class="form-group mb-4">
                                <label for="alamat" class="form-label">Alamat Magang</label>
                                <select id="alamat" name="alamat"
                                    class="form-control form-control-lg @error('alamat') is-invalid @enderror"
                                    required>
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

                            {{-- Catatan Berita --}}
                            <div class="form-group mb-4">
                                <label for="keterangan" class="form-label">Catatan Berita</label>
                                <textarea id="keterangan" name="keterangan"
                                    class="form-control form-control-lg @error('keterangan') is-invalid @enderror"
                                    rows="6" placeholder="Isi catatan berita..." required>{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Simpan dan Reset --}}
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-3">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </button>
                            </div>
                        </form>

                        {{-- Tombol Download PDF --}}
                        @if (session('last_id'))
                            <div class="mt-4 text-end">
                                <a href="{{ route('berita-acara.pdf', session('last_id')) }}" target="_blank"
                                    class="btn btn-primary btn-lg">
                                    <i class="bi bi-download me-1"></i> Download PDF
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Auto-hide alert --}}
<script>
    @if(session('success'))
        setTimeout(function () {
            const alert = document.getElementById('success-alert');
            if (alert) alert.style.display = 'none';
        }, 3000);
    @endif
</script>
