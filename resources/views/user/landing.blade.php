<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Internify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('asset-landing/css/style.css') }}">
</head>
<body>
    <nav class="container-satu" id="navbar">
        <div class="logo">
            <a href="#beranda"><img src="{{ asset('asset-landing/img/logo.png') }}" alt="Logo Internify"></a>
        </div>
        <div class="navbar">
            <ul>
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#sub-judul-2">Informasi</a></li>
                <li><a href="#sub-judul-3">FAQ</a></li>
                <li><a href="#sub-judul-4">Buku Panduan</a></li>
            </ul>
        </div>
    </nav>

    <!-- Section 1 -->
    <section id="beranda">
        <div class="container-dua">
            <div class="judul">
                <h1>Selamat Datang di Internify</h1>
                <p>Internify adalah platform magang Jurusan
                Teknologi Informasi Politeknik Negeri
                Jember yang memudahkan mahasiswa dan
                dosen untuk mengorganisir jadwal atau
                timeline magang</p>
                <a href="#penjelasan">
                    <button class="btn">Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                    </i></button>
                </a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('asset-landing/img/hero-image-trans.png') }}" alt="Hero Image">
            </div>
        </div>
    </section>
    <!-- Akhir Section 1 -->

    <!-- Section 2 -->
    <section id="penjelasan">
        <div class="container-tiga">
            <div class="sub-judul-1">
                <h3>Apa Itu Internify</h3>
                <p>Lorem ipsum dolor sit amet consectetur.
                Morbi tellus pharetra euismod cras ut.
                Ut cursus dictumst vehicula elementum
                fringilla et. Elementum dictum at urna
                faucibus leo maecenas enim nisl. Rutrum
                consectetur id sollicitudin sit. Venenatis
                euismod dui amet quam at nulla dolor. Tortor
                enim vitae in pretium. At augue enim feugiat
                risus. Tellus nisl tincidunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur.
                    Morbi tellus pharetra euismod cras ut.
                    Ut cursus dictumst vehicula elementum
                    fringilla et. Elementum dictum at urna
                    faucibus leo maecenas enim nisl. Rutrum
                    consectetur id sollicitudin sit. Venenatis
                    euismod dui amet quam at nulla dolor. Tortor
                    enim vitae in pretium. At augue enim feugiat
                    risus. Tellus nisl tincidunt.</p>
            </div>
            <div class="filler-image">
                <img src="{{ asset('asset-landing/img/filler.png') }}" alt="Filler Image">
            </div>
        </div>
    </section>
    <!-- Akhir Section 2 -->

    <!-- Section 3 -->
    <section id="sub-judul-2">
        <div class="container-empat">
            <div class="sub-judul-2">
                <h3>Informasi Magang</h3>
            </div>
            <div class="card-parent">
                <div class="card">
                    <div class="header">
                        <img src="{{ asset('asset-landing/img/intern.png') }}" alt="Gambar Internship">
                    </div>
                    <div class="content">
                        <p>Daftar Tempat Magang</p>
                        <button>Cek Tempat</button>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <img src="{{ asset('asset-landing/img/lecturer.png') }}" alt="Gambar Dosen">
                    </div>
                    <div class="content">
                        <p>Daftar Dosen Pembimbing</p>
                        <button>Cek Dosen</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir section 3 -->

    <!-- Section 4 -->
    <section id="sub-judul-3">
        <div class="container-lima">
            <div class="sub-judul-3">
                <h3>Frequently Asked Question (FAQ)</h3>
            </div>
            <ul class="accordion">
                <li>
                    <input type="checkbox" name="accordion" id="one" checked> 
                    <label for="one">Pertanyaan 1</label>
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Obcaecati, quasi rerum
                        at delectus blanditiis temporibus. Blanditiis
                        odit optio veniam autem sunt pariatur et
                        ratione laborum.</p>
                    </div>
                </li>
                <li>
                    <input type="checkbox" name="accordion" id="two"> 
                    <label for="two">Pertanyaan 2</label>
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Obcaecati, quasi rerum
                        at delectus blanditiis temporibus. Blanditiis
                        odit optio veniam autem sunt pariatur et
                        ratione laborum.</p>
                    </div>
                </li>
                <li>
                    <input type="checkbox" name="accordion" id="three"> 
                    <label for="three">Pertanyaan 3</label>
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Obcaecati, quasi rerum
                        at delectus blanditiis temporibus. Blanditiis
                        odit optio veniam autem sunt pariatur et
                        ratione laborum.</p>
                    </div>
                </li>
                <li>
                    <input type="checkbox" name="accordion" id="four"> 
                    <label for="four">Pertanyaan 4</label>
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Obcaecati, quasi rerum
                        at delectus blanditiis temporibus. Blanditiis
                        odit optio veniam autem sunt pariatur et
                        ratione laborum.</p>
                    </div>
                </li>
                <li>
                    <input type="checkbox" name="accordion" id="five"> 
                    <label for="five">Pertanyaan 5</label>
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Obcaecati, quasi rerum
                        at delectus blanditiis temporibus. Blanditiis
                        odit optio veniam autem sunt pariatur et
                        ratione laborum.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- Akhir Section 4 -->

    <!-- Section 5 -->
    <section id="sub-judul-4">
        <div class="container-enam">
            <div class="sub-judul-4">
                <h3>Buku Panduan Magang</h3>
            </div>
            <ul class="accordion-download">
                <a href="https://google.com">
                    <li>
                        Surat Proposal Magang TIF.docx
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                          </svg>
                    </li>
                </a>
                <a href="https://google.com">
                    <li>
                        Surat Proposal Magang TIF.docx
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                          </svg>
                    </li>
                </a> 
                <a href="https://google.com">   
                    <li>
                        Surat Pengantar Magang TIF.docx
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                          </svg>
                    </li>
                </a>
            </ul>
        </div>
    </section>
    <!-- Akhir Section 5 -->

    <!-- Footer -->
    <div class="footer">
        <div class="logo-footer">
            <img src="{{ asset('asset-landing/img/logo.png') }}" alt="Logo Internify">
        </div>
        <div class="base-information">
            <h5>Contact</h5>
            <p>Gedung JTI. Jl. Mastrip PO BOX 164, Jember</p>
            <p>+62 822-6495-8427</p>
            <p>bima.iris758@gmail.com</p>
        </div>
        <div class="social-media">
            <h5>Follow Us</h5>
                <a href="https://facebook.com">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                </a>
                <a href="https://instagram.com">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
                <a href="https://twitter.com">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                    </svg>
                </a>
                <a href="https://github.com">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                    </svg>
                </a>
        </div>
        
    </div>
    <script src="{{ asset('asset-landing/js/script.js')}}">
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>