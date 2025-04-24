<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internify.AI Prompt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #fbefff, #d8e2ff);
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
        }

        .center-container {
            text-align: center;
            margin: auto;
        }

        .input-group {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border: none;
            padding: 14px 20px;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .input-group-text {
            background-color: white;
            border: none;
            cursor: pointer;
            padding-right: 20px;
            padding-left: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .welcome-text {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .logo-img {
            width: 20rem;
            height: auto;
        }
    </style>
</head>
<body>

    <!-- Tampilan Awal -->
    <div class="center-container" id="startContainer">
        <div class="logo">
            <img src="{{ asset('asset-landing/img/logo.png') }}" alt="Logo" class="logo-img me-2">
        </div>        
        <div class="welcome-text">Selamat Datang di Internify.AI</div>
        <form id="startForm">
            <div class="input-group mx-auto" style="max-width: 600px;">
                <input type="text" id="startInput" class="form-control" placeholder="Mau cari informasi seputar magang ?" autocomplete="off">
                <span class="input-group-text" onclick="handleInput()">
                    <i class="bi bi-send-fill"></i>
                </span>
            </div>
        </form>
    </div>

    <script>
        const startForm = document.getElementById('startForm');
        const startInput = document.getElementById('startInput');

        startForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleInput();
        });

        function handleInput() {
            const text = startInput.value.trim();
            if (text) {
                alert("Kamu mengetik: " + text);
                startInput.value = '';
            }
        }

        // Alert otomatis saat mengetik
        startInput.addEventListener('input', () => {
            const text = startInput.value.trim();
            if (text.length === 5) {
                alert(`Kamu baru mengetik: "${text}"`);
            }
        });
    </script>
</body>
</html>