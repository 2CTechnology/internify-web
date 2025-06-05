@extends('layouts.template')

@section('content')
<h4>{{ $header }}</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('assign-dospem.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="kombinasi">Tempat Magang & Program Studi</label>
        <select name="kombinasi" class="form-control" required onchange="splitKombinasi(this.value)">
            <option value="">-- Pilih Kombinasi Tempat & Prodi --</option>
            @foreach($eligibleCombinations as $item)
                <option value="{{ $item->id_tempat }}|{{ $item->id_prodi }}">
                    {{ $item->tempat->nama ?? 'Tempat Tidak Ditemukan' }} - {{ $item->prodi->nama_prodi ?? 'Prodi Tidak Ditemukan' }}
                </option>
            @endforeach
        </select>
    </div>

    <input type="hidden" name="id_tempat" id="id_tempat">
    <input type="hidden" name="id_prodi" id="id_prodi">

    <div class="form-group mt-2">
        <label for="jumlah_kelompok">Jumlah Kelompok</label>
        <input type="number" name="jumlah_kelompok" class="form-control" min="1" placeholder="Kosongkan untuk semua kelompok yang tersedia">
    </div>

    <div class="form-group mt-2">
        <label for="id_dosen">Dosen Pembimbing</label>
        <select name="id_dosen" class="form-control" required>
            <option value="">-- Pilih Dosen Pembimbing --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Assign</button>
</form>

<script>
    function splitKombinasi(val) {
        const [tempat, prodi] = val.split('|');
        document.getElementById('id_tempat').value = tempat;
        document.getElementById('id_prodi').value = prodi;
    }
</script>
@endsection