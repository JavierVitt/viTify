<?php
    require 'function.php';

    session_start();

    if(!isset($_SESSION["admin"])){
      header("Location: adminLogin.php");
      exit;
    }

    $syn = "SELECT * FROM USER";
    $hasil = query($syn);

    if(isset($_POST["search"])){
        $string = $_POST["find"];
        if($string===''){
            $syn = "SELECT * FROM USER";
            $hasil = query($syn);
        }else{
            $syn = "SELECT * FROM USER WHERE username_user = '$string'";
            $hasil = query($syn);
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
    .search-input {
        height: 40px;
        margin-left: 10px;
        }

        .search-button {
        margin-left: 20px;
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
                <a class="nav-link mx-2" href="admin-tambahLagu.php">Tambah Lagu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2 active" href="admin-cekUser.php">Cek Data User</a>
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
<br><br><br><br><br><br>

    <form action="" method="post">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAFTAR USER</h1>
            </div>
            <div class="col-md-2">
                <label for=""><span style="font-weight: bold; font-size:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cari User :</span></label>
            </div>
            <div class="col-md-2">
                <input type="text" name="find" class="search-input" style="height: 35x;">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" name="search" type="submit" style="height: 35x;">Search</button>
            </div>
        </div>
    </div>
    </form>

    <!-- Table Playlist -->
    <div class="container">
      <table class="table table-bordered">
          <tr class="table-dark">
            <td>No</td>
            <td>ID User</td>
            <td>Username User</td>
            <td>Action</td>
          </tr>
          <?php $j = 0; ?>
          <?php foreach($hasil as $hasil) : ?>
            <tr>
            <td>
              <?php echo $j; ?>
            </td>
            <td>
                <?php echo $hasil["id_user"]; ?>
            </td>
            <td>
                <?php echo $hasil["username_user"]; ?>
            </td>
            <td>
                <a class="btn btn-danger" href="deleteUser.php?user_id=<?php echo $hasil["id_user"]; ?>">Delete Data</a>
            </td>
          </tr>
          <?php $j++; ?>
            <?php endforeach; ?>
      </table>
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
