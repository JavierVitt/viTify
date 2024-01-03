<?php
require 'function.php';
session_start();

global $conn;

$user = $_GET["id_user"];
$id = $_GET["id_playlist"];

$syn = "SELECT * FROM TRACK_LAGU WHERE id_playlist = $id";
$hasilTrack = query($syn);

foreach ($hasilTrack as $hasil) {
    $idLagu = $hasil["id_lagu"];

    $syntax = "SELECT * FROM LAGU WHERE id_lagu = $idLagu";
    $result = query($syntax);

    $lempar = $result[0]["link"];

    $que = unserialize($_SESSION["queue"]);
    $que->enqueue($lempar);
    $_SESSION["queue"] = serialize($que);
}
    echo "<script>document.location.href='index.php?id_user=$user'</script>";
?>
