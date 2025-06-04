@foreach ($data as $item)
    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">Detail Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- Detail Dosen Pembimbing --}}
                    <label class="form-label">NIDN Dosen</label>
                    <input type="text" class="form-control"
                        value="{{ $item->kelompok->dospem->no_identitas ?? '-' }}" readonly>

                    <label class="form-label mt-2">Nama Dosen</label>
                    <input type="text" class="form-control" value="{{ $item->kelompok->dospem->name ?? '-' }}"
                        readonly>

                    <hr>

                    {{-- Detail Anggota Kelompok --}}
                    @foreach ($item->kelompok->anggota as $itemAnggota)
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" class="form-control" readonly value="{{ $itemAnggota->nim ?? '-' }}">

                            <label class="form-label mt-2">Nama</label>
                            <input type="text" class="form-control" readonly value="{{ $itemAnggota->nama ?? '-' }}">

                            <label class="form-label mt-2">No HP</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $itemAnggota->no_telp ?? '-' }}">

                            <label class="form-label mt-2">Program Studi / Angkatan / Golongan</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $itemAnggota->prodi->nama_prodi ?? '-' }} ({{ $itemAnggota->angkatan ?? '-' }}) Gol. {{ $itemAnggota->golongan ?? '-' }}">
                        </div>
                        <hr>
                    @endforeach

                    {{-- Alamat Instansi --}}
                    <label class="form-label mt-2">Alamat Instansi</label>
                    <input type="text" class="form-control" readonly
                        value="{{ $item->tempatMagang->alamat ?? '-' }}">

                    {{-- Revisi Proposal --}}
                    @if (!is_null($item->revisi_proposal))
                        <label class="form-label mt-2">Revisi Proposal</label>
                        <textarea class="form-control" rows="3" disabled>{{ $item->revisi_proposal }}</textarea>
                    @endif

                    {{-- Alasan Proposal Ditolak --}}
                    @if (!is_null($item->alasan_proposal_ditolak))
                        <label class="form-label mt-2">Alasan Proposal Ditolak</label>
                        <textarea class="form-control" rows="3" disabled>{{ $item->alasan_proposal_ditolak }}</textarea>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
