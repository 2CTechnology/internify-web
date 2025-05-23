    <div class="container-dosen">
        @forelse ($data as $item)
            <div class="card-parent-dosen">
                <div class="card-dosen">
                    <div class="header-dosen">
                        <img src="{{asset($item->foto)}}" alt="Foto Dosen">
                    </div>
                    <div class="content-dosen">
                        <p>{{ $item->name }}</p>
                        <p>{{ $item->no_identitas }}</p>                   
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                Detail Data
                            </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="card-parent-dosen">
                <div class="card-dosen">
                    <div class="header-dosen">
                        <img src="{{asset('asset-landing/img/lecturer.png')}}" alt="Foto Tempat Magang">
                    </div>
                    <div class="content-dosen">
                        <p>Tidak Ada Data</p>
                    </div>
                </div>
            </div>
        @endforelse
</div>