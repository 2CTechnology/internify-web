<nav class="container-satu" id="navbar">
    <div class="logo">
        <a href="/"><img src="{{ asset('asset-landing/img/logo.png') }}" alt="Logo Internify"></a>
    </div>
    <div class="navbar">
        @if (Request::is('/'))
        <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#sub-judul-2">Informasi</a></li>
            <li><a href="#sub-judul-3">FAQ</a></li>
            <li><a href="#sub-judul-4">Buku Panduan</a></li>
        </ul>
        @else
        <ul>
            <li><a href="/#beranda">Beranda</a></li>
            <li><a href="/#sub-judul-2">Informasi</a></li>
            <li><a href="/#sub-judul-3">FAQ</a></li>
            <li><a href="/#sub-judul-4">Buku Panduan</a></li>
        </ul>
        @endif
       
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
</form>

    </div>
</nav>