<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Kode OTP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
  }
  .email-container {
    background-color: #ffffff;
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  h1 {
    color: #4666DE;
    text-align: center;
    font-size: 24px;
  }
  .otp-code {
    font-size: 36px;
    color: #000000;
    text-align: center;
    margin: 20px 0;
    font-weight: bold;
    letter-spacing: 3px;
  }
  p {
    font-size: 14px;
    color: #333333;
    text-align: center;
  }
</style>
</head>
<body>
  <div class="email-container">
    <h1>Kode OTP Anda</h1>
    <div class="otp-code">{{ $param['otp'] }}</div>
    <p>Masukkan kode OTP ini untuk melanjutkan proses reset password. Jangan berikan kode ini kepada siapapun.</p>
    <p>Terima kasih!</p>
  </div>
</body>
</html>
