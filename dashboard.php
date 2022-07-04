<?php
session_start();
if(isset($_SESSION['username'])){
    $conn = new PDO("mysql:host=localhost;dbname=first_mile", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $logged = $conn->prepare("SELECT * FROM admin_tbl WHERE username = :username");
    $stmt = $conn->prepare("SELECT * FROM riders");
    $logged->execute(['username' => $_SESSION['username']]);
    $stmt->execute();
    $count = $stmt->rowCount();
    $admin = $logged->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Dashboard</title>
</head>
<body class="bg-slate-900">
<div class="wrapper">
  <!-- Modal Delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" id="deleteBtn" value="">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete Pos-->
  <div class="modal fade" id="deleteModalPos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" id="deleteBtnPosModal" value="">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete Contact-->
  <div class="modal fade" id="deleteModalCont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" id="deleteBtnContModal" value="">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mt-3">
            <input class="form-control" type="text" id="firstNameEdit" value="">
          </div>
          <div class="input-group mt-3">
            <input class="form-control" type="text" id="middleNameEdit">
          </div>
          <div class="input-group mt-3 mb-3">
            <input class="form-control" type="text" id="lastNameEdit">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="editBtn" value="">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Edit Position -->
  <div class="modal fade" id="editModalPos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mt-3">
            <input class="form-control" type="text" id="posEdit" value="">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="editBtnPos" value="">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Contacts -->
  <div class="modal fade bd-example-modal-lg" id="editModalCont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" id="formEditCont">
             <div class="input-group mt-3">
            
            <div class="row">
              <input type="file" accept="image/*" name="imageContE" id="imageContE"/>

              
            </div>
          <div class="row">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="firstNameContE">Firstname</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="text" name="firstNameContE" id="firstNameContE" value="">
              </div>  
            </div>
            <div class="input-group mt-3 col-lg" >
              <div>
                <label for="middleNameContE">Middlename</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="text" name="middleNameContE" id="middleNameContE">
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="lastNameContE">Lastname</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="text" name="lastNameContE" id="lastNameContE">
              </div>
            </div>
          </div>
          
          <div class="row w-100">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="posContE">Position</label>
              </div>
              <div class="w-100" id="posContEDiv">
                <select class="form-control w-100" id="posContE" name="position">
                  <option value="position">Position</option>
                </select>
              </div>   
            </div>
            <div class="input-group mt-3 col-lg justify-content-center" >
                        
                  <div class="row w-100 icheck-primary m-2">
                    <input class="occuE" id="singleR" type="radio" name="occu" value="SINGLE">
                    <label for="singleR">Single</label>
                  </div>
    
                  <div class="row w-100 icheck-primary m-2">
                    <input class="occuE" id="marriedR" type="radio" name="occu" value="MARRIED">
                    <label for="marriedR">Married</label>
                  </div>
              
            </div>
            <div class="input-group mt-3 col-lg justify-content-center">
              
                <div class="row w-100 icheck-primary m-2">
                  <input class="gendE" id="maleR" type="radio" name="gend" value="MALE">
                  <label for="maleR">Male</label>
                </div>
                <div class="row w-100 icheck-primary m-2">
                  <input class="gendE" id="femaleR" type="radio" name="gend" value="FEMALE">
                  <label for="femaleR">Female</label>
                </div>  
              
              
            </div>
          </div>

          <div class="row">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="contNoE">Contact No.</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="number" name="contNoE" id="contNoE">
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="bDateE">Birtdate</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="date" name="bDateE" id="bDateE">
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="dateHiredE">Date Hired</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="date" name="dateHiredE" id="dateHiredE">
              </div> 
            </div>
          </div>

          <div class="row">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="sssE">SSS</label>
              </div>
              <div>
                <input class="form-control" type="number" name="sssE" id="sssE">
              </div>  
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="phlhE">Philhealth</label>
              </div>
              <div>
                <input class="form-control" type="number" name="phlhE" id="phlhE">
              </div>   
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="pagIE">Pag-Ibig</label>
              </div>
              <div>
                <input class="form-control" type="number" name="pagIE" id="pagIE">
              </div> 
            </div>
            <div class="container input-group mt-3 col-lg">
              <div>
                <label for="tinE">TIN</label>
              </div>
              <div>
                <input class="form-control" type="number" name="tinE" id="tinE">
              </div>
            </div>  
          </div>
          </div>   
          
          
        </div>

        <div class="modal-footer">
          <input type="hidden" name="idEdit" id="idEdit">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="editBtnCont" value="">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal view contacts -->
  <div class="modal fade bd-example-modal-lg" id="viewModalCont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mt-3 w-100">
          <div id="imageDiv">
            </div>
          <div class="row w-100">
      
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="firstNameContV">Firstname</label>
              </div>
              <div class="w-100">
                <h3 id="firstNameContV"></h3>
              </div>  
            </div>
            <div class="input-group mt-3 col-lg" >
              <div>
                <label for="middleNameContV">Middlename</label>
              </div>
              <div class="w-100">
                <h3 id="middleNameContV"></h3>
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="lastNameContV">Lastname</label>
              </div>
              <div class="w-100">
                <h3 id="lastNameContV"></h3>
              </div>
            </div>
          </div>
          
          <div class="row w-100">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="posContV">Position</label>
              </div>
              <div class="w-100" id="posContEDiv">
                <h3 id="posContV"></h3>
              </div>   
            </div>

            <div class="input-group mt-3 col-lg" >
             
                <div>
                  <label for="civContV">Civil Status</label>
                </div>
                <div class="w-100" id="posContEDiv">
                  <h3 id="civContV"></h3>
                </div>
              
            </div>

            <div class="input-group mt-3 col-lg">
              
                <div>
                  <label for="gendContV">Gender</label>
                </div>
                <div class="w-100" id="posContEDiv">
                  <h3 id="gendContV"></h3>
                </div>
              
              
            </div>
          </div>

          <div class="row w-100">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="contNoV">Contact No.</label>
              </div>
              <div class="w-100">
                <h3 id="contNoV"></h3>
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="bDateV">Birtdate</label>
              </div>
              <div class="w-100">
                <h3 id="bDateV"></h3>
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="dateHiredV">Date Hired</label>
              </div>
              <div class="w-100">
                <h3 id="dateHiredV"></h3>
              </div> 
            </div>
          </div>

          <div class="row w-100">
            <div class="input-group mt-3 col-lg">
              <div class="w-100">
                <label for="sssV">SSS</label>
              </div>
              <div>
                <h3 id="sssV"></h3>
              </div>  
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="phlhV">Philhealth</label>
              </div>
              <div>
                <h3 id="phlhV"></h3>
              </div>   
            </div>
            <div class="input-group mt-3 col-lg">
              <div class="w-100">
                <label for="pagIV">Pag-Ibig</label>
              </div>
              <div class="w-100">
                <h3 id="pagIV"></h3>
              </div> 
            </div>
            <div class="container input-group mt-3 col-lg">
              <div class="w-100">
                <label for="tinV">TIN</label>
              </div>
              <div class="w-100">
                <h3 id="tinV"></h3>
              </div>
            </div>  
          </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="editBtnCont" value="">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Contacts -->
  <div class="modal fade bd-example-modal-lg" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Contacts</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="firstNameCont">Firstname</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="text" id="firstNameCont" value="">
              </div>  
            </div>
            <div class="input-group mt-3 col-lg" >
              <div>
                <label for="middleNameCont">Middlename</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="text" id="middleNameCont">
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="lastNameCont">Lastname</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="text" id="lastNameCont">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="pos">Position</label>
              </div>
              <div class="w-100">
                <select class="form-control w-100" id="pos" name="position">
                  <option value="position">Position</option>
                </select>
              </div>   
            </div>
            <div class="input-group mt-3 col-lg justify-content-center" >
              <div class="row">
                <div class="row w-100 icheck-primary m-2">
                  <input class="form-control occu" id="single" type="radio" name="occu" value="SINGLE">
                  <label for="single">Single</label>
                </div>
                <div class="row w-100 icheck-primary m-2">
                  <input class="form-control occu" id="married" type="radio" name="occu" value="MARRIED">
              
                  <label for="married">Married</label>
                </div>
              </div>
              
            </div>
            <div class="input-group mt-3 col-lg justify-content-center">
              <div class="row">
                <div class="row w-100 icheck-primary m-2">
                  <input class="form-control gend" type="radio" name="gend" value="MALE">
                  <label>Male</label>
                </div>
                <div class="row w-100 icheck-primary m-2">
                  <input class="form-control gend" type="radio" name="gend" value="FEMALE">
                  <label>Female</label>
                </div>
              </div>  
            </div>
          </div>

          <div class="row">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="contNo">Contact No.</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="number" id="contNo">
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="bDate">Birtdate</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="date" id="bDate">
              </div>
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="dateHired">Date Hired</label>
              </div>
              <div class="w-100">
                <input class="form-control w-100" type="date" id="dateHired">
              </div> 
            </div>
          </div>

          <div class="row">
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="sss">SSS</label>
              </div>
              <div>
                <input class="form-control" type="number" id="sss">
              </div>  
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="phlh">Philhealth</label>
              </div>
              <div>
                <input class="form-control" type="number" id="phlh">
              </div>   
            </div>
            <div class="input-group mt-3 col-lg">
              <div>
                <label for="pagI">Pag-Ibig</label>
              </div>
              <div>
                <input class="form-control" type="number" id="pagI">
              </div> 
            </div>
            <div class="container input-group mt-3 col-lg">
              <div>
                <label for="tin">TIN</label>
              </div>
              <div>
                <input class="form-control" type="number" id="tin">
              </div>
            </div>  
          </div>
          
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="contSub" value="">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal add position -->
  <div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add position</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mt-3">
            <input class="form-control" type="text" id="positionInp" value="" placeholder="Add position">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="posSubBtn" value="">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <p class="text-light m-0"><strong><?php echo $admin['first_name']; echo " "; echo $admin['last_name'];?></strong></p>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="contactsBtn">
              <i class="nav-icon fas fa-phone-alt"></i>
              <p>
                Contacts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="positionBtn">
              <i class="nav-icon ion ion-person"></i>
              <p>
                Position form
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" id="pageTitle">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" id="dashboard">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $count; ?></h3>

                <p>Total Registered Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
        </div>
    
        <div class="row">
          <!-- Left col -->
          <div class="col-lg">
              <div class="card bg-light w-100">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    Users
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-dark btn-sm" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body">
                  <div class="row">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Firstname</th>
                          <th>Middlename</th>
                          <th>Lastname</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="usersData">
                      </tbody>
                    </table>
                  </div>
                
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <!-- /.row -->
                </div>
              </div>
              
          </div>
          
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section >
    <!-- /.content -->

    <!--CONTACTS SECTION-->
    <section class="content d-none" id="contacts">
      <div class="container-fluid">
        <div class="row m-1 mb-3">
          <div class="row w-100">
            <div class="col-lg">
              <button class="btn btn-primary" id="AddContactsBtn">Add</button>
              <button class="btn btn-primary" id="viewExcelContacts">View Excel</button>
            </div>
            
            <div class="col-lg">
              <form action="" method="post" id="formExcelCont">
                <div class="custom-file">
                  <input class="custom-file-input mb-1" type="file" name="excelUpload" id="excelUpload">
                  <label class="custom-file-label" for="excelUpoad">Choose file</label>
                </div>
                
                <button class="btn btn-success" type="submit">Submit Excel</button>
                <button type="button" class="btn btn-primary" id="genExcel">Generate Excel</button>
              </form>
            </div>
            
            
          </div>
          
        </div>
        <div class="row m-1">
          <!-- Left col -->
          <div class="col-lg">
              <div class="card bg-light w-100">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    Contacts
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-dark btn-sm" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body overflow-auto">
                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Firstname</th>
                          <th>Middlename</th>
                          <th>Lastname</th>
                          <th>Position</th>
                          <th>Civil Status</th>
                          <th>Gender</th>
                          <th>Contact No</th>
                          <th>Birth Date</th>
                          <th>Date Hired</th>
                          <th>SSS</th>
                          <th>Philhealth</th>
                          <th>Pagibig</th>
                          <th>TIN</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="contData">
                      </tbody>
                  </table>
                
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <!-- /.row -->
                </div>
              </div>
              
          </div>
          
          <!-- right col -->
        </div>
      </div>
    </section>
    <section class="content d-none" id="position">
      <div class="container-fluid">
        <div class="row m-1 mb-3">
          <div class="col-lg">
            <button class="btn btn-primary" id="addPositionBtn">Add</button>
          </div>
          
        </div>
        <div class="row m-1">
          <!-- Left col -->
          <div class="col-lg">
              <div class="card bg-light w-100">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    Position
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-dark btn-sm" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body">
                  <div class="row">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Position</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="positionData">
                      </tbody>
                    </table>
                  </div>
                
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <!-- /.row -->
                </div>
              </div>
              
          </div>
          
          <!-- right col -->
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="plugins/chart.js/Chart.min.js"></script>

<script src="plugins/sparklines/sparkline.js"></script>

<script src="plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="plugins/moment/moment.min.js"></script>

<script src="plugins/daterangepicker/daterangepicker.js"></script>

<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="plugins/summernote/summernote-bs4.min.js"></script>

<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="dist/js/adminlte.js"></script>

<script type="text/javascript" src="delete.js"></script>

<script type="text/javascript" src="contactPage.js"></script>
</body>

</html>
<?php
}
else{
    header("location: login.php");
}
?>