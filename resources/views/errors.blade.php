<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #374151;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            font-size: 5rem;
            margin: 0;
            color: #ef4444;
        }
        p {
            font-size: 1.25rem;
        }
        a {
            margin-top: 1rem;
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <p>Halaman tidak ditemukan atau akses tidak diperbolehkan.</p>
    <a href="{{ url('/login') }}">Kembali ke Login</a>
</body>
</html>