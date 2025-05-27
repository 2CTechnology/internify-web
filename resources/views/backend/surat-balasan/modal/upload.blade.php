{{-- modal ubah status --}}
<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="ubahStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('surat-balasan.tindak-lanjut') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="ubahStatusLabel">Ubah Status Surat Balasan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="hidden-id-status">

                <label for="select-status">Status</label>
                <select name="status_surat_balasan" id="select-status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="diterima">Diterima</option>
                    <option value="mengulang">Mengulang (bikin proposal lagi)</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
