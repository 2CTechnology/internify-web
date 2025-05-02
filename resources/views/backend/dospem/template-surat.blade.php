<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Monitoring Magang</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h3 {
            text-align: center;
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
        }

        .signature td {
            text-align: center;
            vertical-align: top;
        }

        .box {
            border: 1px solid #000;
            min-height: 100px;
            padding: 10px;
        }

        ol {
            margin-left: 20px;
        }

        .section {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h3>FORMULIR BERITA ACARA MONITORING DAN EVALUASI</h3>

    <p>
        Pada hari ini {{ $hari }} tanggal {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }} di {{ $tempat }},
        telah dilaksanakan monitoring dan evaluasi Magang mahasiswa program studi {{ $program_studi }} Jurusan {{ $jurusan }}
        Politeknik Negeri Jember atas nama:
    </p>

    <ol>
        @foreach($mahasiswa as $nama)
            @if($nama)
                <li>{{ $nama }}</li>
            @endif
        @endforeach
    </ol>

    <p class="section">dengan pembimbing lapang:</p>
    <ol>
        <li>Nama : {{ $pembimbing_nama }}</li>
        <li>Divisi/Departemen : {{ $pembimbing_divisi }}</li>
        <li>Jabatan : {{ $pembimbing_jabatan }}</li>
    </ol>

    <p class="section"><strong>Catatan selama pelaksanaan monitoring dan evaluasi Magang:</strong></p>
    <div class="box">
        {{ $catatan }}
    </div>

    <p class="section">
        Demikian berita acara monitoring dan evaluasi Magang ini dibuat dan diketahui oleh dosen pembimbing dan pembimbing lapang.
    </p>

    <!-- Tambahan baris tanggal -->
    <p style="text-align: right; margin-top: 40px;">
        .........., ..............
    </p>

    <table class="signature">
        <tr>
            <td>Pembimbing Lapang</td>
            <td>Dosen Pembimbing</td>
        </tr>
        <tr>
            <td style="padding-top: 60px;">________________________</td>
            <td style="padding-top: 60px;">________________________</td>
        </tr>
    </table>

</body>
</html>