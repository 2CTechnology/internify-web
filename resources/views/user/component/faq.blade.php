<section id="sub-judul-3">
    <div class="container-lima">
        <div class="sub-judul-3">
            <h3>Frequently Asked Question (FAQ)</h3>
        </div>
        <ul class="accordion">
            @forelse ($faq as $key => $item)
                <li>
                    <input type="checkbox" name="accordion" id="one" @checked($key == 0)> 
                    <label for="one">{{ $item->pertanyaan }}</label>
                    <div class="content">
                        <p>{{ $item->jawaban }}</p>
                    </div>
                </li>
            @empty
                <li>
                    <input type="checkbox" name="accordion" id="one" checked> 
                    <label for="one">Tidak Ada Data.</label>
                    <div class="content">
                        <p>-</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</section>