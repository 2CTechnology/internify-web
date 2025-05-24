<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lembar Rekomendasi Evaluasi Lokasi Magang</title>
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
        .content-section {
            border: 1px solid #000;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center mb-4">
            <h3 class="text-uppercase">LEMBAR REKOMENDASI UNTUK EVALUASI LOKASI MAGANG</h3>
        </div>

        <p class="text-justify">
            Bahwa berdasarkan pengamatan selama kegiatan monitoring dan evaluasi Magang yang dilaksanakan di:
        </p>

        <p>
            1. Lokasi Magang : {{ $evaluasi->tempatMagang->nama_tempat ?? '-' }}<br>
            2. Tanggal : {{ \Carbon\Carbon::parse($evaluasi->tanggal)->translatedFormat('d F Y') }}
        </p>

        <p class="text-justify">
            Ada beberapa hal yang dapat kami sampaikan mengenai lokasi Magang tersebut:
        </p>

        <div class="content-section">
            {{ $evaluasi->keterangan }}
        </div>

        <p class="text-justify mt-4">
            Maka lokasi Magang ini <strong>layak/tidak layak*</strong> untuk penempatan Magang pada tahun selanjutnya.
        </p>

        <p style="text-align: right; margin-bottom: 20px;">
            Jember, {{ \Carbon\Carbon::parse($evaluasi->tanggal)->translatedFormat('d F Y') }}
        </p>

        <!-- Tanda Tangan -->
        <table style="width: 100%; margin-top: 25px; text-align: center;">
            <tr>
                <td style="padding-top: 78px;">
                    Dosen Pembimbing<br><br><br><br>
                    ________________________
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
