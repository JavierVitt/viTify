<?php
require 'function.php';
session_start();

$que = unserialize($_SESSION["queue"]);
$throw = $que->dequeue();
$_SESSION["queue"] = serialize($que);

echo $throw;
?>