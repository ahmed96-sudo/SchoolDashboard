<?php
    session_start();
    include("../backendAll/connect.php");
    $path = $_SESSION['path'];
    $file = $_SESSION['file'];
    $filepath = $_SESSION['filepath'];
    header("Content-Type: application/pdf");
    // header("Content-Disposition: inline; filename=" . basename($filepath));
    header("Content-Transfer-Encoding: binary");
    header("Accept-Ranges: bytes");
    @readfile($filepath);
?>