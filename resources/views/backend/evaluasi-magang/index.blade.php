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
                        {{-- Tambahkan header jika diperlukan --}}
                    </div>
                    <div class="card-body p-4">
                        <!-- Menampilkan notifikasi jika ada -->
                        @if (session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('evaluasi-magang.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="tempat_magang_id" class="form-label">Lokasi Magang</label>
                                <select class="form-control form-control-lg" id="tempat_magang_id" name="tempat_magang_id" required>
                                    <option selected disabled>-- Pilih Lokasi Magang --</option>
                                    @foreach($tempat_magangs as $tempat)
                                        <option value="{{ $tempat->id }}" {{ old('tempat_magang_id') == $tempat->id ? 'selected' : '' }}>
                                            {{ $tempat->alamat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="tanggal" class="form-label">Tanggal Evaluasi</label>
                                <input type="date" class="form-control form-control-lg" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="keterangan" class="form-label">Catatan</label>
                                <textarea class="form-control form-control-lg" id="keterangan" name="keterangan" rows="6"
                                          placeholder="Tulis keterangan evaluasi magang di sini..." required></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-lg">Kirim</button>
                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-3">Reset</button>
                            </div>
                        </form>
                    </div>

                    @if(session('last_id'))
                        <div class="card-footer text-end bg-white border-top-0">
                            <a href="{{ route('evaluasi-magang.pdf', session('last_id')) }}" target="_blank" class="btn btn-primary btn-lg">
                                <i class="bi bi-download me-2"></i>Download PDF
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    @if(session('success'))
        setTimeout(function () {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) alertBox.style.display = 'none';
        }, 3000);
    @endif
</script>
