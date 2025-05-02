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
                    <form>
                        <div class="form-group mb-4">
                            <label for="tanggal" class="form-label">Tanggal Acara</label>
                            <input type="date" class="form-control form-control-lg" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control form-control-lg" id="keterangan" name="keterangan" rows="6" placeholder="Tulis keterangan berita acara di sini..." required></textarea>
                        </div>

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
