<?php
require 'function.php';
session_start();


if (!isset($_SESSION["queue"])) {
    $_SESSION["queue"] = new Queue(); // Inisialisasi objek Queue jika belum ada dalam session
}

$id = $_GET["id_user"];
$lagu = $_GET["id_lagu"];

$syn = "SELECT * FROM LAGU WHERE id_lagu = $lagu";
$hasil = query($syn);

$result = $hasil[0]["link"];

var_dump($result);

$que = unserialize($_SESSION["queue"]);
$que->enqueue($result);
$_SESSION["queue"]=serialize($que);


echo "<script>document.location.href='index.php?id_user=$id'</script>";
?>