<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbdata = "man";
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdata);
    if (mysqli_connect_errno()) {
        die("ERROR:Couldn't Connent." . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    };

?>