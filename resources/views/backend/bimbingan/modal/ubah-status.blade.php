{{--  Ganti id modal agar tidak bentrok dengan <select> --}}
<div class="modal fade" id="modal-ubah-status" tabindex="-1" aria-labelledby="ubahStatusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('status-bimbingan.edit') }}" method="post" class="modal-content">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="ubahStatusLabel">Ubah Status Jadwal Bimbingan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>

        <div class="modal-body">
            {{-- hidden id jadwal --}}
            <input type="hidden" name="id" id="hidden-id-status">

            <label for="select-status">Status</label>
            {{-- ganti id = select-status, name tetap "ubah_status" --}}
            <select name="ubah_status" id="select-status" class="form-control">
                <option value="">-- Pilih Status --</option>
                <option value="pending">Pending</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>