<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
</head>
<body class="bg-dark hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1 class="text-dark">Login</h1>
    </div>
    <div class="card-body">

      <form action="process.php" method="post">
        <div class="input-group mb-3 mt-5">
            <input class="form-control" placeholder="Username" type="text" id="userName" name="username" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control" placeholder="Password" type="password" id="password" name="password" required>
            <div class="input-group-append">
                <button type="button" onclick="toggle()" class="far fa-eye btn btn-outline-secondary"></button>
            </div>
        </div>
        <div class="container">
          <div class="row justify-content-center mt-2 mb-2">
            <button type="submit" class="btn btn-primary m-4" name="login">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new user</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
    <!--<div class="container p-5">
        <h1 class="row justify-content-md-center align-middle text-white">Login</h1>
    </div>
    <form action="process.php" method="POST" class="container w-25 justify-content-md-center">
        <div class="row m-4">
            <label class="w-100 text-white" for="userName">Username:</label>  
            <div class="input-group">
               <input class="form-control d-block" type="text" id="userName" name="username"> 
            </div>
            
        </div>
        <div class="row m-4">
            <label class="w-100 text-white" for="passWord">Password:</label> 
            <div class="input-group">
                <input class="form-control d-block" type="password" id="password" name="password">
                <div class="input-group-append">
                    <button type="button" onclick="toggle()" class="far fa-eye btn btn-light"></button>
                </div>
                
            </div>
            
        </div>
        <div class="row justify-content-md-center align-middle">
            <button type="submit" class="btn btn-primary m-4" name="login">Submit</button>
            <button type="submit" class="btn btn-success m-4" name="regRedirect">Register</button>
        </div>
    </form>-->
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
</body>
</html>