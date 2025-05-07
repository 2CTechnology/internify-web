<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="modalUploadLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUploadLabel">Konfirmasi Surat Pelaksanaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('surat-pelaksanaan.update') }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id-upload">
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menandai surat pelaksanaan ini telah dibuat?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Ya, Tandai Selesai</button>
            </div>
        </form>
      </div>
    </div>
</div>
