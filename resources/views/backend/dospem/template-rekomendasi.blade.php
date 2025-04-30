<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekomendasi Evaluasi Lokasi Magang</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h4 {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .no-border {
            border: none;
        }

        .signature {
            margin-top: 40px;
            width: 100%;
        }

        .signature td {
            text-align: center;
            vertical-align: top;
            padding-top: 40px;
        }

        .right {
            text-align: right;
        }

        .italic {
            font-style: italic;
        }

        .bold {
            font-weight: bold;
        }

        .no-border, .no-border td {
    border: none !important;
}
    </style>
</head>
<body>

    <h4>LEMBAR REKOMENDASI UNTUK EVALUASI LOKASI MAGANG</h4>

    <p>
        Bahwa berdasarkan pengamatan selama kegiatan monitoring dan evaluasi Magang yang dilaksanakan di:
    </p>

    <p>
        1. Lokasi Magang : {{ $lokasi }} <br>
        2. Tanggal       : {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
    </p>

    <p>
        Ada beberapa hal yang dapat kami sampaikan mengenai lokasi Magang tersebut:
    </p>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($catatan as $i => $isi)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $isi }}</td>
            </tr>
            @endforeach
            @for($i = count($catatan); $i < 4; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>&nbsp;</td>
            </tr>
            @endfor
        </tbody>
    </table>

    <p style="margin-top: 20px;">
        Maka lokasi Magang ini <span class="bold">layak/tidak layak*</span> untuk penempatan Magang pada tahun selanjutnya.
    </p>

    <table class="signature no-border">
        <tr>
            <td class="no-border"></td>
            <td class="no-border">Jember, {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="no-border"></td>
            <td class="no-border">Dosen Pembimbing</td>
        </tr>
        <tr>
            <td class="no-border" style="height: 60px;"></td>
            <td class="no-border" style="height: 60px;"></td>
        </tr>
        <tr>
            <td class="no-border"></td>
            <td class="no-border">…………………………..</td>
        </tr>
    </table>

</body>
</html>