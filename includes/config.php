<?php 
    ob_start(); // to connect start database
    session_start();

    $timezone = date_default_timezone_set("Europe/Moscow");
    $con = mysqli_connect("localhost", "root", "", "spotify");

    if(mysqli_connect_errno()) { // error when connecting to mysql
        echo "Failed to connect: " . mysqli_connect_errno();
    }

?>