<?php
session_start();
if(isset($_SESSION['username'])){
    //$conn = new PDO("mysql:host=localhost;dbname=first_mile", "root", "");
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body class="bg-slate-900">
    <div class="grid grid-cols-3 grid-rows-1">
        <div></div>
        <div class="grid place-content-center p-5">
            <h1 class="font-bold text-4xl text-white">Insert</h1>    
        </div>
        <div class="grid grid-rows-1 grid-cols-2 place-content-center p-5">
            <button class="text-white">Computation</button>
            <button class="text-white" id="dshBtn">Dashboard</button>
        </div>
    </div>
    
    <div class="container w-70 mx-auto grid place-content-center gap-2 mt-10">
        <div class="w-64">
            <label class="block text-white" for="firstName">Firstname:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="firstName" name="regUsername">
        </div>
        <div class="w-64">
            <label class="block text-white" for="middleName">Middlename:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="middleName" name="email">
        </div>
        <div>
            <label class="block text-white" for="lastName">Lastname:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="lastName" name="regPassword">
        </div>
        <div>
            <label class="block text-white" for="suffix">Suffix:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="suffix" name="cPassword">
        </div>
        <div>
            <label class="block text-white" for="position">Position:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="position" name="cPassword">
        </div>
        <div>
            <label class="block text-white" for="employment">Employment:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="employment" name="cPassword">
        </div>
        <div>
            <label class="block text-white" for="client">Client:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="client" name="cPassword">
        </div>
        <div>
            <label class="block text-white" for="hub">Hub:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="hub" name="cPassword">
        </div>
        <div>
            <label class="block text-white" for="accNo">Account No.:</label>
            <input class="w-full h-8 rounded-lg" type="number" id="accNo" name="cPassword">
        </div>
        <div>
            <label class="block text-white" for="accName">Account Name:</label>
            <input class="w-full h-8 rounded-lg" type="text" id="accName" name="cPassword">
        </div>
        <div class="grid place-content-center p-5">
            <button class="bg-sky-400 text-xl w-28 h-12 font-bold rounded-xl" id="insBtn">Submit</button>
        </div>
    </div>
<script src="insert_ajax.js"></script>
</body>
</html>
<?php
}
?>