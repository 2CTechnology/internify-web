@extends('layouts.template')

@section('content')
<div class="container">
    <h3>Assign Dosen Pembimbing</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('assignments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Kelompok</label>
            <select name="id_kelompok" class="form-control" required>
                <option value="">-- Pilih Kelompok --</option>
                @foreach($kelompoks as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelompok }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tempat Magang</label>
            <select name="id_tempat_magang" class="form-control" required>
                <option value="">-- Pilih Tempat Magang --</option>
                @foreach($tempatMagangs as $t)
                    <option value="{{ $t->id }}">{{ $t->nama }} - {{ $t->kota }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
    <label>Dosen Pembimbing (Ploting)</label>
    <input type="text" class="form-control" value="Dosen ID: {{ $ploting->id_dosen }} | Kota: {{ $ploting->kota }} | Sisa: {{ $ploting->jumlah_kelompok }}" disabled>
    <input type="hidden" name="id_ploting_dosen" value="{{ $ploting->id }}">
</div>


        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" value="{{ date('Y') }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan (Opsional)</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Assign</button>
    </form>
</div>
@endsection