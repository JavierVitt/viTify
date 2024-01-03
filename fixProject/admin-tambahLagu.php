<?php
    require 'function.php';

    session_start();

    if(!isset($_SESSION["admin"])){
      header("Location: adminLogin.php");
      exit;
    }

    if(isset($_POST["create"])){
        if(addLagu($_POST)>0){
            echo "<script>alert('berhasil')</script>";
        }else{
            echo "<script>alert('Link Youtube Sudah terdaftar')</script>";
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <title>PETIFY</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>


  <style>
    .center {
      margin: auto;
      width: 50%;

      padding: 10px;
    }

    .button_cancel {
      margin-left: 0%;
      margin-top: 15%;
      width: 100%;
      height: 50%;
      background-color: rgb(184, 28, 28);
      color: rgb(255, 255, 255);
      padding: 5px;
    }

    .button_create {
      margin-left: 0%;
      margin-top: 15%;
      width: 100%;
      height: 50%;
      background-color: black;
      color: bisque;
      padding: 5px;
    }
    .navbar {
            background: -webkit-linear-gradient(right,#003366,#004080,#0059b3
      , #0073e6);
        }
        footer {
            background: -webkit-linear-gradient(right,#003366,#004080,#0059b3
      , #0073e6);
        }
  </style>
</head>

<body>

  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  <header>
    <div style="position: fixed; z-index: 10; width: 100%;">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Selamat Datang, Admin</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
              <li>
                <h1 style="color: dark;">&nbsp;</h1>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2 active" href="#">Tambah Lagu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="admin-cekUser.php">Cek Data User</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" aria-current="page" href="admin-cekLagu.php">Cek Lagu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="admin-cekInput.php">Cek Input User</a>
              </li>
              <a class="nav-link mx-2" href="adminLogout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

<br><br><br><br>

  <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6" id="fill">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="center" style="font-size : 35px">Tambah Lagu</h1>
                        <br>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <br> -->
                                <label for="resi" class="form-label">Judul lagu</label>
                                <input class="form-control" id="resi" type="text" name="nama" placeholder="Nama Lagu" required autofocus autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="resi" class="form-label">Nama penyanyi</label>
                                <input class="form-control" id="resi" type="text" name="penyanyi" placeholder="Nama Penyanyi" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="resi" class="form-label">Genre</label>
                                <input class="form-control" id="resi" type="text" name="genre" placeholder="Genre" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="resi" class="form-label">Tanggal Publish</label>
                                <input class="form-control" id="resi" type="date" name="tanggal" placeholder="Tanggal rilis" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="resi" class="form-label">Link Youtube</label>
                                <input class="form-control" id="resi" type="text" name="lagu" placeholder="Link Youtube" required autocomplete="off">                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="button_cancel" type="submit" name="cancel" id="entry">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button class="button_create" type="submit" name="create" id="entry">Create</button>
                            </div>
                        </div>
                </form>
            </div>
        <div class="col-md-3"></div>
  </div>
</div>

<footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Created by Javier, Hansel, Nelson, Robert</p>
      </div>
    </div>
  </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
