<?php
require 'function.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$syn = "SELECT * FROM LAGU";
$lagus = query($syn);

$id = $_GET["id_user"];

$synNama = "SELECT * FROM USER WHERE id_user = $id";
$nama = query($synNama);

$syntax = "SELECT * FROM PLAYLIST WHERE id_user = $id";
$playlists = query($syntax);

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

//Add Playlist
if (isset($_POST["create"])) {

  if (newPlaylist($id, $_POST) > 0) {
    echo "<script>alert('Berhasil')</script>";
    echo "<script>document.location.href='redirect.php?id_user=$id'</script>";
  } else {
    echo "<script>alert('Gagal')</script>";
  }
}

if(isset($_POST["btn"])){
  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <title>PETIFY</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />


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

    #fill {
      margin: auto;
      padding: 40px;
      border: 10px;
      /* solid black */
      border-radius: 10%;
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
          <a class="navbar-brand" href="#">Selamat Datang, <?php echo $nama[0]['username_user'] ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
              <li>
                <h1 style="color: dark;">&nbsp;</h1>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" aria-current="page" href="index.php?id_user=<?php echo $id; ?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2 active" href="#">Playlist Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="user-AddLagu.php?id_user=<?php echo $id; ?>">Add Song</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="adminLogin.php?id_user=<?php echo $id; ?>">Admin Center</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="logout.php">Logout</a>
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
            <h1 class="center" style="font-size : 36px">New Playlist</h1>
            <br>
          </div>
        </div>
        <form action="" method="post">
          <div class="row">
            <div class="col-md-12">
              <br>
              <label for="resi" class="form-label">Playlist name</label>
              <input class="form-control" id="resi" type="text" name="nama" placeholder="Name" required autofocus autocomplete="off">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <br>
              <label for="resi" class="form-label">Description</label>
              <input class="form-control" id="resi" type="text" name="deskripsi" placeholder="Description" autocomplete="off">
            </div>
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

  <br><br>


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAFTAR LAGU</h1>
      </div>
      <div class="col-md-2">
        <label for=""><span style="font-weight: bold; font-size:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cari Lagu : </span></label>
      </div>
      <div class="col-md-2">
        <input type="text" name="search" class="search-input" style="height: 35x;">
      </div>
      <div class="col-md-2">
        <button class="btn btn-success" name="btn" type="submit" style="height: 35x;" >Search</button>
      </div>
    </div>
  </div>
  <div class="container">
    <table class="table table-bordered">
      <tr class="table-dark">
        <td>No</td>
        <td>Judul Lagu</td>
        <td>Penyanyi</td>
        <td>Add to Playlist</td>
      </tr>
      <?php $i = 0; ?>
      <?php foreach ($lagus as $lagu) : ?>
        <tr>
          <td>
            <?php echo $i ?>
          </td>
          <td>
            <?php echo $lagu["judul_lagu"]; ?>
          </td>
          <td>
            <?php echo $lagu["penyanyi"]; ?>
          </td>
          <td>
            <?php foreach ($playlists as $plist) : ?>
              <a class="btn btn-success" href="addLaguToPlaylist.php?id_user=<?php echo $id; ?>&id_playlist=<?php echo $plist["id_playlist"];?>&id_lagu=<?php echo $lagu["id_lagu"];?>"><?php echo $plist["nama_playlist"] ?></a>
              <br>
            <?php endforeach; ?>
          </td>
        </tr>
        <?php $i++; ?>
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