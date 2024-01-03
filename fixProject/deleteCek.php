<?php
    require 'function.php';
    global $conn;

    $id = $_GET["id"];

    $syn = "DELETE FROM CEK WHERE id_cek = $id";
    mysqli_query($conn,$syn);
    mysqli_affected_rows($conn);

    echo "<script>document.location.href='admin-cekInput.php'</script>";
?>