<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = $_POST['otp'];

    if ($enteredOtp == $_SESSION['otp']) {
        unset($_SESSION['otp']); // Optional cleanup
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>OTP Verified</title>
          <style>
            body {
              font-family: Arial, sans-serif;
              background: #f3f4f6;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
            }

            .toast {
              padding: 20px 30px;
              background-color: #22c55e;
              color: white;
              border-radius: 8px;
              font-size: 1rem;
              box-shadow: 0 8px 20px rgba(0,0,0,0.1);
              animation: fadein 0.5s ease-in-out;
            }

            @keyframes fadein {
              from { opacity: 0; transform: translateY(-20px); }
              to { opacity: 1; transform: translateY(0); }
            }
          </style>
        </head>
        <body>
          <div class='toast'>✅ OTP Verified! Redirecting to TaskSpark...</div>
          <script>
            setTimeout(function() {
              window.location.href = 'http://localhost/weather/index.html';
            }, 2000);
          </script>
        </body>
        </html>
        ";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>OTP Invalid</title>
          <style>
            body {
              font-family: Arial, sans-serif;
              background: #fef2f2;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
            }

            .toast {
              padding: 20px 30px;
              background-color: #ef4444;
              color: white;
              border-radius: 8px;
              font-size: 1rem;
              box-shadow: 0 8px 20px rgba(0,0,0,0.1);
              animation: fadein 0.5s ease-in-out;
            }

            @keyframes fadein {
              from { opacity: 0; transform: translateY(-20px); }
              to { opacity: 1; transform: translateY(0); }
            }
          </style>
        </head>
        <body>
          <div class='toast'>❌ Invalid OTP. Please try again.</div>
          <script>
            setTimeout(function() {
              window.location.href = 'otp_verify.html';
            }, 2000);
          </script>
        </body>
        </html>
        ";
    }
} else {
    echo "Invalid Request.";
}
?>
