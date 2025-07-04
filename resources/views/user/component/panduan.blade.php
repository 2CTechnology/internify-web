<section id="sub-judul-4">
    <div class="container-enam">
        <div class="sub-judul-4">
            <h3>Buku Panduan Magang</h3>
        </div>
        <ul class="accordion-download" dusk="download-panduan">
            @forelse ($fileTemplate as $key => $item)
                <a href="{{ asset($item->file) }}" download>
                    <li>
                        {{ $item->nama_file }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                        </svg>
                    </li>
                </a>
            @empty
                <a href="#">
                    <li>
                        Tidak Ada data.
                    </li>
                </a>
            @endforelse
        </ul>
    </div>
</section>