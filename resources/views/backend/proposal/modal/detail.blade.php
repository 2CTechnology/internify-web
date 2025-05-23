@foreach ($data as $item)
    
<div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Mahasiswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <label for="nama" class="label-form-control">NIDN Dosen</label>
            <input type="text" class="form-control" value="{{ $item->kelompok->dospem ? $item->kelompok->dospem->no_identitas : '-' }}" readonly >

            <label for="nama" class="label-form-control mt-2">Nama Dosen</label>
            <input type="text" class="form-control" value="{{ optional($item->kelompok->dospem)->name }}" readonly >
            <hr>
            @foreach ($item->kelompok->anggota as $itemAnggota)
                <label for="nama" class="label-form-control mt-2">NIM</label>
                <input type="text" class="form-control" readonly value="{{ $itemAnggota->nim }}">
                
                <label for="nama" class="label-form-control mt-2">Nama</label>
                <input type="text" class="form-control" readonly value="{{ $itemAnggota->nama }}">
                
                <label for="nama" class="label-form-control mt-2">Program Studi</label>
                <input type="text" class="form-control" readonly value="{{ $itemAnggota->prodi->nama_prodi }}({{ $itemAnggota->angkatan }}) Gol. {{ $itemAnggota->golongan }}">
                <hr>
            @endforeach

            @if ($item->revisi_proposal != null)
              <label for="nama" class="label-form-control mt-2">Revisi Proposal</label>
                <textarea name="" id="" cols="" rows="" class="form-control" disabled>{{ $item->revisi_proposal }}</textarea>
            @endif

            @if ($item->alasan_proposal_ditolak != null)
              <label for="nama" class="label-form-control mt-2">Alasan Ditolak</label>
                <textarea name="" id="" cols="" rows="" class="form-control" disabled>{{ $item->alasan_proposal_ditolak }}</textarea>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach