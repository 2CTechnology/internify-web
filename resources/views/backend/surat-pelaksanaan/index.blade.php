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
        <div class="col-md-12"> {{-- Perbesar card ke 12 kolom supaya cukup dua kolom form --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    {{-- Bisa kasih judul di sini kalau mau --}}
                    <h5 class="mb-0">Form Berita Acara</h5>
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="textarea1" class="form-label">Nomor Induk Mahasiswa</label>
                                    <textarea class="form-control form-control-lg" id="textarea1" name="textarea1" rows="1" placeholder="" required></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="textarea2" class="form-label">Nama Mahasiswa</label>
                                    <textarea class="form-control form-control-lg" id="textarea2" name="textarea2" rows="1" placeholder="" required></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="textarea3" class="form-label">Nama Kelompok</label>
                                    <textarea class="form-control form-control-lg" id="textarea3" name="textarea3" rows="1" placeholder="" required></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="textarea4" class="form-label">Dosen Pembimbing</label>
                                    <textarea class="form-control form-control-lg" id="textarea4" name="" rows="1" placeholder="" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="textarea5" class="form-label">Nama Tempat Magang</label>
                                    <textarea class="form-control form-control-lg" id="textarea5" name="" rows="1" placeholder="" required></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="textarea6" class="form-label">Alamat Tempat Magang</label>
                                    <textarea class="form-control form-control-lg" id="textarea6" name="" rows="1" placeholder="" required></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="textarea7" class="form-label">Lama Magang</label>
                                    <textarea class="form-control form-control-lg" id="textarea7" name="" rows="1" placeholder="" required></textarea>
                                </div>

                               
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success btn-lg">Generate Surat</button>
                            <button type="reset" class="btn btn-outline-secondary btn-lg ms-3">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
