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
            Pada hari ini {{ \Carbon\Carbon::parse($berita->jadwal)->translatedFormat('l') }}
            tanggal {{ \Carbon\Carbon::parse($berita->jadwal)->translatedFormat('d F Y') }}
            di {{ $berita->tempatMagang->nama_tempat ?? '-' }},
            telah dilaksanakan monitoring dan evaluasi Magang mahasiswa program studi
            {{ $berita->prodi }} Jurusan{{ $berita->jurusan }}
            Politeknik Negeri Jember atas nama kelompok
            {{ $berita->kelompok->nama_kelompok ?? '-' }} dengan anggota sebagai berikut:
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
                <strong> Catatan selama pelaksanaan monitoring dan evaluasi Magang:</strong><br />
            <div style="border: 1px solid #000; padding: 10px; margin-top: 20px;">
                {{ $berita->keterangan }}
            </div>

            </p>

            <p class="text-justify mb-0">
                Demikian berita acara monitoring dan evaluasi Magang ini dibuat dan diketahui oleh dosen pembimbing dan
                pembimbing lapang.
            </p>
        </div>
        <p style="text-align: right; margin-bottom: 20px;">
            Jember, {{ \Carbon\Carbon::parse($berita->jadwal)->translatedFormat('d F Y') }}
        </p>
        <!-- Tanda Tangan -->
        <table style="width: 100%; margin-top: 50px; text-align: center;">
            <tr>
                <td style="padding-top: 78px;">
                    Pembimbing Lapang<br /><br /><br /><br />
                    ________________________
                </td>

                <td style="padding-top: 78px;">
                    Dosen Pembimbing<br /><br /><br /><br />
                    ________________________
                </td>
            </tr>
        </table>

</body>

</html>