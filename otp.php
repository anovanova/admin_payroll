<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>OTP</title>
</head>
<body class="bg-slate-900">
    <div class="grid place-content-center p-5">
        <h1 class="font-bold text-4xl text-white">OTP</h1>
    </div>
    <form action="process.php" method="POST" class="container mx-auto grid place-content-center gap-2 mt-10">
        <div>
            <label class="block text-white" for="otp">OTP:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="otp" name="otp">
        </div>
        <div class="grid place-content-center p-5">
            <button type="submit" class="bg-sky-400 text-xl w-28 h-12 font-bold rounded-xl" name="otpSub">Submit</button>
        </div>
    </form>
    
</body>
</html>