<div class="modal fade" id="modalTindakLanjut" tabindex="-1" aria-labelledby="modalTindakLanjutLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTindakLanjutLabel">Tindak Lanjut Proposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('proposal.store') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="id-tindak-lanjut">
            <div class="modal-body">
                <label for="tindak_lanjut" class="label-form-control">Tindak Lanjut</label>
                <select name="tindak_lanjut" id="tindak_lanjut" class="form-control">
                    <option value="">-- Tindak Lanjut --</option>
                    <option value="diterima">Setujui</option>
                    <option value="revisi">Revisi</option>
                    <option value="ditolak">Tolak</option>
                </select>
                <label for="revisi" id="revisi-label" class="label-form-control revisi-label mt-2 d-none">Revisi</label>
                <textarea name="revisi" id="revisi" cols="" rows="" class="form-control d-none"></textarea>
                
                <label for="alasan_ditolak" id="alasan_ditolak-label" class="label-form-control alasan_ditolak-label mt-2 d-none">Alasan Ditolak</label>
                <textarea name="alasan_ditolak" id="alasan_ditolak" cols="" rows="" class="form-control d-none"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>