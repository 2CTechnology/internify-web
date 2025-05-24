@foreach ($data as $item)
    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail {{ $item->nama_Tempat }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="nama" class="label-form-control">Alamat</label>
                    <textarea name="" id="" cols="" rows="" class="form-control" readonly>{{ $item->alamat }}</textarea>

                    <label for="nama" class="label-form-control">Website</label>
                    <input type="text" class="form-control" readonly value="{{ $item->website ?? '-' }}">

                    <label for="nama" class="label-form-control">Jumlah Karyawan</label>
                    <input type="text" class="form-control" readonly value="{{ $item->employee_size ?? '-' }}">

                    <label for="nama" class="label-form-control">Head Office</label>
                    <input type="text" class="form-control" readonly value="{{ $item->head_office ?? '-' }}">

                    <label for="nama" class="label-form-control">Berdiri Sejak</label>
                    <input type="text" class="form-control" readonly value="{{ $item->since ?? '-' }}">

                    <label for="nama" class="label-form-control">Spesialisasi</label>
                    <input type="text" class="form-control" readonly value="{{ $item->specialization ?? '-' }}">

                    <label for="nama" class="label-form-control">Kriteria</label>
                    <input type="text" class="form-control" readonly value="{{ $item->kriteria ?? '-' }}">

                    <label for="nama" class="label-form-control">Posisi</label>
                    <input type="text" class="form-control" readonly value="{{ $item->posisi ?? '-' }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach