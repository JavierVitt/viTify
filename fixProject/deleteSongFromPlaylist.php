<?php
    require 'function.php';
    global $conn;

    $idTrack = $_GET["id_track"];
    $id = $_GET["id_user"];

    $syn = "DELETE FROM TRACK_LAGU WHERE id_track = $idTrack";
    mysqli_query($conn,$syn);

    echo "<script>document.location.href='index.php?id_user=$id'</script>";
?>