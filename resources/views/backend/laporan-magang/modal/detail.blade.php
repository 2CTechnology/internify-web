@foreach ($data as $item)
    <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1"
        aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="form-label">NIDN Dosen</label>
                    <input type="text" class="form-control"
                        value="{{ $item->kelompok->dospem->no_identitas ?? '-' }}" readonly>

                    <label class="form-label mt-2">Nama Dosen</label>
                    <input type="text" class="form-control" value="{{ $item->kelompok->dospem->name ?? '-' }}"
                        readonly>
                    <hr>

                    @foreach ($item->kelompok->anggota as $anggota)
                        <label class="form-label mt-2">NIM</label>
                        <input type="text" class="form-control" value="{{ $anggota->nim }}" readonly>

                        <label class="form-label mt-2">Nama</label>
                        <input type="text" class="form-control" value="{{ $anggota->nama }}" readonly>

                        <label class="form-label mt-2">Program Studi</label>
                        <input type="text" class="form-control"
                            value="{{ $anggota->prodi->nama_prodi }} ({{ $anggota->angkatan }}) Gol. {{ $anggota->golongan }}"
                            readonly>
                        <hr>
                    @endforeach

                    @if ($item->status_laporan === 'revisi' && $item->catatan)
                        <div class="form-group">
                            <label>Catatan Revisi</label>
                            <textarea class="form-control" readonly>{{ $item->catatan }}</textarea>
                        </div>
                    @endif


                    @if ($item->laporan)
                        <label class="form-label mt-2">File Laporan Magang</label>
                        <div>
                            <a href="{{ asset($item->laporan) }}" target="_blank" class="btn btn-success">
                                <i class="fa fa-download"></i> Laporan Magang
                            </a>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
