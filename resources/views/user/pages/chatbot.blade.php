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

        #sendBtn {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="center-container" id="startContainer">
        <div class="logo">
            <img src="asset-landing/img/logo.png" alt="Logo" class="logo-img me-2">
        </div>
        <div class="welcome-text">Selamat Datang di Internify.AI</div>
        <div class="center-container" id="chatbotContainer" style="width: 100%; height: 85vh;">
            <div class="container mt-4" style="max-width: 700px;">
                <form id="chatForm">
                    <div class="input-group">
                        <input type="text" id="userInput" class="form-control" placeholder="Ketik pertanyaan magang kamu..." required>
                        <button type="submit" class="input-group-text" id="sendBtn"><i class="bi bi-send-fill"></i></button>
                    </div>
                </form>
                <div id="chatResponse" class="mt-3 p-3 bg-light rounded shadow-sm" style="min-height: 60px;"></div>
            </div>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chatForm');
        const userInput = document.getElementById('userInput');
        const chatResponse = document.getElementById('chatResponse');

        chatForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const pertanyaan = userInput.value.trim();
            if (!pertanyaan) return;

            chatResponse.innerHTML = "<i class='bi bi-arrow-repeat'></i> Memproses jawaban...";

            try {
                const response = await fetch("http://167.71.192.145/chatbot", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ pertanyaan })
                });

                if (!response.ok) throw new Error("HTTP error " + response.status);

                const data = await response.json();
                chatResponse.innerHTML = `<strong>Jawaban:</strong> ${data.jawaban}`;
            } catch (error) {
                chatResponse.innerHTML = "Terjadi kesalahan saat menghubungi server.";
                console.error("Error:", error);
            }

            userInput.value = '';
        });
    </script>

</body>
</html>