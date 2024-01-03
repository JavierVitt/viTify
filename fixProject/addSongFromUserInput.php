<?php
    require 'function.php';

    global $conn;

    $id = $_GET["id"];

    $syn = "SELECT * FROM cek WHERE id_cek = $id";
    $result = query($syn);

    // var_dump($id);
    // var_dump($result);

    $judul = $result[0]["judul_laguc"];
    $penyanyi = $result[0]["penyanyic"];
    $genre = $result[0]["genrec"];
    $tanggal = $result[0]["tanggal_rilisc"];
    $link = $result[0]["linkc"];

    $syntax = "INSERT INTO LAGU VALUES ('','$judul','$penyanyi','$genre','$tanggal','$link')";
    mysqli_query($conn,$syntax);

    $syntax = "DELETE FROM CEK WHERE id_cek = $id";
    mysqli_query($conn,$syntax);

    echo "<script>document.location.href='admin-cekInput.php'</script>";
?>