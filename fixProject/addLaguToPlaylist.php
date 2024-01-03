<?php
    require 'function.php';

    $user = $_GET["id_user"];
    $playlist = $_GET["id_playlist"];
    $lagu = $_GET["id_lagu"];

    addLaguToPlaylist($user,$lagu,$playlist);

    echo "<script>document.location.href='formLagu.php?id_user=$user'</script>";
?>