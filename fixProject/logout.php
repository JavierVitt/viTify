<?php
    session_start();

    // if(isset($_SESSION["login"])){
    //     echo "<script>alert('Ada !!')</script>";
    // }else{
    //     echo "<script>alert('Tidak ada !!')</script>";
    // }

    session_destroy();
    header("Location: login.php");
    exit;
?>