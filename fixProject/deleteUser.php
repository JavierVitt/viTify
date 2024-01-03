<?php
    require 'function.php';

    $id = $_GET["user_id"];

    deleteUserFromPlaylist($id);
    deleteUser($id);

    header('Location: admin-cekUser.php');
    exit;
?>