@foreach ($data as $item)
<!-- Modal -->
  <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail {{$item->nama_tempat}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- Pake Form Pas Detail Data Modal --}}
            <form>
                <fieldset disabled>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">Nama Tempat</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->nama_tempat }}">

                      <label for="disabledTextInput" class="form-label">Head Office</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->head_office }}">

                      <label for="disabledTextInput" class="form-label">Alamat</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->alamat }}">

                      <label for="disabledTextInput" class="form-label">Deskripsi Perusahaan</label>
                      <textarea id="disabledTextInput" class="form-control" rows="4">{{ $item->deskripsi_perusahaan }}</textarea>

                      <label for="disabledTextInput" class="form-label">Deskripsi Pekerjaan</label>
                      <textarea id="disabledTextInput" class="form-control" rows="4">{{ $item->deskripsi_pekerjaan }}</textarea>

                      <label for="disabledTextInput" class="form-label">Website</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->website }}">

                      <label for="disabledTextInput" class="form-label">Jumlah Karyawan</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->employee_size }}">

                      <label for="disabledTextInput" class="form-label">Berdiri Sejak</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->since }}">

                      <label for="disabledTextInput" class="form-label">Spesialisasi</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->specialization }}">

                      <label for="disabledTextInput" class="form-label">Kriteria</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->kriteria }}">

                      <label for="disabledTextInput" class="form-label">Posisi</label>
                      <input type="text" id="disabledTextInput" class="form-control" value="{{ $item->posisi }}">
                    </div>
                  </fieldset>
            </form>

            {{-- Kalo Pake Table Pas Detail Data Modal --}}

            {{-- <table class="table table-bordered">
                <thead class="table-light d-flex gap-2 flex-column">
                    <tr class="d-flex gap-2">
                        <td scope="col" class="flex-grow-2 col-3 d-flex justify-content-between">
                            <p>Nama</p>
                            <p>:</p>
                        </td>
                        <td scope="col" class="flex-grow-1">
                            value
                        </td>
                    </tr>
                    <tr class="d-flex gap-2">
                        <td scope="col" class="flex-grow-2 col-3 d-flex justify-content-between">
                            <p>Kota</p>
                            <p>:</p>
                        </td>
                        <td scope="col" class="flex-grow-1">
                            value
                        </td>
                    </tr>
                    <tr class="d-flex gap-2">
                        <td scope="col" class="flex-grow-2 col-3 d-flex justify-content-between">
                            <p>Alamat</p>
                            <p>:</p>
                        </td>
                        <td scope="col" class="flex-grow-1">
                            value
                        </td>
                    </tr>
                    <tr class="d-flex gap-2">
                        <td scope="col" class="flex-grow-2 col-3 d-flex justify-content-between">
                            <p>Detail Tempat</p>
                            <p>:</p>
                        </td>
                        <td scope="col" class="flex-grow-1">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, quo ea. Corrupti dolorem incidunt doloremque. Ea harum veritatis possimus mollitia?
                        </td>
                    </tr>
                </thead>
            </table> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><p>Close</p></button>
        </div>
      </div>
    </div>
</div>
@endforeach