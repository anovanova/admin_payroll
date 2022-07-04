<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Registration</title>
</head>
<body class="bg-dark container w-25 justify-content-md-center mt-5 mb-5">

<div class="modal fade" id="otpDiv" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-dark" id="exampleModalCenterTitle">OTP</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="process.php" method="POST" class="container w-70 mx-auto grid place-content-center gap-2 mt-4-10">
      <div class="modal-body">
                <div id="otpLabel" >
                    <input class="form-control d-block" type="text" id="otp" name="otp">
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="otpSub">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1 class="h1 text-dark">Registration</h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form method="post" id="formReg">
          <div class="input-group mb-3">
            <input class="form-control" type="text" id="RegUserName" placeholder="Username" name="regUsername" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control" type="text" id="Email" placeholder="Email" name="email" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control" type="password" placeholder="Password" id="RegPassword" name="regPassword" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control" type="password" placeholder="Confirm Password" id="CPassword" name="cPassword" required>
        </div>
        <div class="mt-4 mb-4 container">
            <div class="row justify-content-center">
                <button type="button" class="far fa-eye btn btn-light" id="toggleBtn"></button>
            </div>  
        </div>
        <div class="input-group mb-3">
            <input class="form-control" type="text" placeholder="Firstname" id="firstName" name="regUsername" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Middlename" id="middleName" name="email" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Lastname" id="lastName" name="regPassword" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Suffix" id="suffix" name="cPassword">
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Position" id="position" name="cPassword" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Employment Status" id="employment" name="cPassword" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Client" id="client" name="cPassword" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Hub" id="hub" name="cPassword" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="number" placeholder="Account Number" id="accNo" name="cPassword" required>
        </div>
        <div class="input-group mb-3">
            <input class="form-control d-block" type="text" placeholder="Account Name" id="accName" name="cPassword" required>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-2 mb-2">
               <button type="submit" class="btn btn-primary" id="otpBtn">Submit</button> 
            </div> 
          <!-- /.col -->
        </div>
      </form>
        



      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
    
    <!--otp-->
    <!--<div hidden id="otpDiv" class="w-screen h-screen absolute z-25">
        <form action="process.php" method="POST" class="container w-70 mx-auto grid place-content-center gap-2 mt-4-10">
            <div class="grid place-content-center p-5 backdrop-brightness-50 bg-slate-900/90 rounded-xl z-50" id="otp">
                <div class="grid place-content-center p-5">
                    <h1  class="font-bold text-4xl text-white" id="otpHeader" >OTP</h1>
                </div>
                <div id="otpLabel" >
                    <label class="block text-white" for="otp"  >OTP:</label>
                    <input class="form-control d-block" type="text" id="otp" name="otp">
                </div>

                <div class="grid place-content-center p-5">
                    <button  type="submit" class="bg-sky-400 text-xl w-28 h-12 font-bold rounded-xl" id="otpSub" name="otpSub">Submit</button>
                </div>
            </div>
        </form>
    </div>-->

    <!-- reg header -->
    <!--<div class="container p-5" id="header">
        <h1 class="row justify-content-md-center text-white">Registration</h1>
    </div>-->

    <!-- registration form -->
    <!--<div class="container w-25 justify-content-md-center" id="regForm">
        <div class="m-2 mt-4">
            <label class="block text-white" for="RegUserName">Username:</label>
            <input class="form-control" type="text" id="RegUserName" name="regUsername">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="Email">Email:</label>
            <input class="form-control d-block" type="text" id="Email" name="email">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="RegPassword">Password:</label>
            <input class="form-control d-block" type="password" id="RegPassword" name="regPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="CPassword">Confirm Password:</label>
            <input class="form-control d-block" type="password" id="CPassword" name="cPassword">
        </div>
        <div class="mt-4 container">
            <div class="row justify-content-center">
                <button type="button" class="far fa-eye btn btn-light" id="toggleBtn"></button>
            </div>  
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="firstName">Firstname:</label>
            <input class="form-control d-block" type="text" id="firstName" name="regUsername">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="middleName">Middlename:</label>
            <input class="form-control d-block" type="text" id="middleName" name="email">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="lastName">Lastname:</label>
            <input class="form-control d-block" type="text" id="lastName" name="regPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="suffix">Suffix:</label>
            <input class="form-control d-block" type="text" id="suffix" name="cPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="position">Position:</label>
            <input class="form-control d-block" type="text" id="position" name="cPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="employment">Employment:</label>
            <input class="form-control d-block" type="text" id="employment" name="cPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="client">Client:</label>
            <input class="form-control d-block" type="text" id="client" name="cPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="hub">Hub:</label>
            <input class="form-control d-block" type="text" id="hub" name="cPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="accNo">Account No.:</label>
            <input class="form-control d-block" type="number" id="accNo" name="cPassword">
        </div>
        <div class="m-2 mt-4">
            <label class="block text-white" for="accName">Account Name:</label>
            <input class="form-control d-block" type="text" id="accName" name="cPassword">
        </div>
        <div class="container">
            <div class="row justify-content-center m-5">
               <button type="button" class="btn btn-primary" id="otpBtn">Submit</button> 
            </div>   
        </div>
    </div>-->

    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="toggle_reg.js"></script>

</body>
</html>