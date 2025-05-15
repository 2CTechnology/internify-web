<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulir Berita Acara Monitoring dan Evaluasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
            padding: 40px;
        }

        .text-justify {
            text-align: justify;
        }

        .signature-line {
            margin-top: 60px;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center mb-4">
            <h3 class="text-uppercase">Formulir Berita Acara Monitoring dan Evaluasi</h3>
        </div>

        <p class="text-justify">
            Pada hari ini <strong>{{ \Carbon\Carbon::parse($berita->jadwal)->translatedFormat('l') }}</strong>
            tanggal <strong>{{ \Carbon\Carbon::parse($berita->jadwal)->translatedFormat('d F Y') }}</strong>
            di <strong>{{ $berita->tempatMagang->nama_tempat ?? '-' }}</strong>,
            telah dilaksanakan monitoring dan evaluasi Magang mahasiswa program studi
            <strong>{{ $berita->prodi }}</strong> Jurusan <strong>{{ $berita->jurusan }}</strong>
            Politeknik Negeri Jember atas nama kelompok
            <strong>{{ $berita->kelompok->nama_kelompok ?? '-' }}</strong> dengan anggota sebagai berikut:
        </p>

        <ol class="mb-3">
            @if(isset($berita->kelompok) && $berita->kelompok->anggota && $berita->kelompok->anggota->count() > 0)
                @foreach ($berita->kelompok->anggota as $anggota)
                    <li>{{ $anggota->nama }}</li>
                @endforeach
            @else
                <li>Data anggota tidak tersedia.</li>
            @endif
        </ol>

        <div class="border border-dark rounded p-3 mt-3 content-section">
            <p class="mb-2">
                <strong>Catatan selama pelaksanaan monitoring dan evaluasi Magang:</strong><br />
                {{ $berita->keterangan }}
            </p>

            <p class="text-justify mb-0">
                Demikian berita acara monitoring dan evaluasi Magang ini dibuat dan diketahui oleh dosen pembimbing dan
                pembimbing lapang.
            </p>
        </div>

        <!-- Tanda Tangan -->
        <table class="w-100 mt-5 text-center">
            <tr>
                <td>
                    {{ '..................' }}<br />
                    Pembimbing Lapang<br /><br /><br /><br />
                    ________________________
                </td>


                <td>
                    {{ $berita->tempatMagang->nama_tempat ?? '..................' }},
                    {{ \Carbon\Carbon::parse($berita->jadwal)->translatedFormat('d F Y') }}<br />
                    Dosen Pembimbing<br /><br /><br /><br />
                    ________________________
                </td>
            </tr>
        </table>
    </div>

</body>

</html>