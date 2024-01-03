<?php
    require 'function.php';

    $id = $_GET["id"];

    deleteLagu($id);

    echo "<script>document.location.href='admin-cekLagu.php'</script>";
?>