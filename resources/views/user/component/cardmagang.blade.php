<div class="container-magang">
    @forelse ($data as $item)
        <div class="card-parent-magang">
            <div class="card-magang">
                <div class="header-magang">
                    <img src="{{asset('asset-landing/img/intern.png')}}" alt="Foto Tempat Magang">
                </div>
                <div class="content-magang">
                    <p>{{ $item->nama_tempat }}</p>
                    <p>{{ $item->head_office }}</p>
                        <button dusk="btn-detail-tempat-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                            Detail Data
                        </button>
                </div>
            </div>
        </div>
    @empty
        <div class="card-parent-magang">
            <div class="card-magang">
                <div class="header-magang">
                    <img src="{{asset('asset-landing/img/intern.png')}}" alt="Foto Tempat Magang">
                </div>
                <div class="content-magang">
                    <p>Tidak Ada Data</p>
                </div>
            </div>
        </div>
        
    @endforelse
</div>