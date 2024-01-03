<?php
    require 'function.php';
    global $conn;

    $idCek = $_GET["id_cek"];

    $syn = "SELECT * FROM CEK WHERE id_cek = $id";
    $hasil = query($syn);

    $judul = $hasil["judul_lagu"];
    $penyanyi = $hasil["penyanyi"];
    $genre = $hasil["genre"];
    $tanggal = $hasil["tanggal_rilis"];
    $link = $hasil["link"];

    $syntax = "INSERT INTO LAGU VALUES ('','$judul','$penyanyi','$genre','$tanggal','$link')";
    mysqli_query($conn,$syntax);

    echo "<script>document.location.href='admin-cekInput.php'</script>";
?>