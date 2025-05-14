<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
        }
        h1 {
            text-align: center;
        }
        p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <h1>Berita Acara</h1>

    <p><strong>Tanggal Acara:</strong> {{ $data->jadwal }}</p>
    <p><strong>Tempat Magang:</strong> {{ $data->tempatMagang->nama_tempat ?? '-' }}</p>
    <p><strong>Prodi:</strong> {{ $data->prodi }}</p>
    <p><strong>Jurusan:</strong> {{ $data->jurusan }}</p>
    <p><strong>Alamat:</strong> {{ $data->alamat }}</p>
    <p><strong>Catatan:</strong> {{ $data->keterangan }}</p>
</body>
</html>
