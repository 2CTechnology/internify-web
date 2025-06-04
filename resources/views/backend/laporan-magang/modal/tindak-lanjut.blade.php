<div class="modal fade" id="modalTindakLanjut" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('laporan-magang.tindak-lanjut') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="id-tindak-lanjut">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tindak Lanjut</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tindak_lanjut">Status</label>
                        <select name="tindak_lanjut" id="tindak_lanjut" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="diterima">Diterima</option>
                            <option value="revisi">Revisi</option>
                        </select>
                    </div>

                    <div class="form-group d-none" id="revisi-label">
                        <label for="catatan">Catatan Revisi</label>
                        <textarea name="catatan" id="revisi" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>