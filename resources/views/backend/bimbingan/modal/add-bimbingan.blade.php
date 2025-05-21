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
                        <h4>Tambah Jadwal Bimbingan</h4>
                    </div>
                    <div class="card-body p-4">

                        <!-- Menampilkan error validasi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Menampilkan pesan sukses jika ada -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Form untuk menambah jadwal bimbingan -->
                        <form method="POST" action="{{ route('bimbingan.store') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="id_kelompok" class="form-label">Nama Kelompok</label>
                                <select class="form-control form-control-lg @error('id_kelompok') is-invalid @enderror"
                                    name="id_kelompok" required>
                                    <option value="">-- Pilih Nama Kelompok --</option>
                                    @foreach ($kelompoks as $kelompok)
                                        <option value="{{ $kelompok->id }}"
                                            {{ old('id_kelompok') == $kelompok->id ? 'selected' : '' }}>
                                            {{ $kelompok->nama_kelompok }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelompok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Tanggal -->
                            <div class="form-group mb-4">
                                <label for="tanggal" class="form-label">Tanggal Acara</label>
                                <input type="datetime-local"
                                    class="form-control form-control-lg @error('jadwal') is-invalid @enderror"
                                    id="tanggal" name="jadwal" value="{{ old('jadwal', now()->format('Y-m-d\TH:i')) }}"
                                    {{-- default: sekarang --}} required>

                                @error('jadwal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Catatan -->
                            <div class="form-group mb-4">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control form-control-lg @error('catatan') is-invalid @enderror" id="keterangan" name="catatan"
                                    rows="6" placeholder="Tulis keterangan berita acara di sini...">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-lg">Kirim</button>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-3">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
