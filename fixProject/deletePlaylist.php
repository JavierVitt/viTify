<?php
    require 'function.php';

    $idUser = $_GET["id_user"];
    $idPlaylist = $_GET["id_playlist"];

    deletePlaylist($idPlaylist);

    echo "<script>document.location.href='index.php?id_user=$idUser'</script>";
?>