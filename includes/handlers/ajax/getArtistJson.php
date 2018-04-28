<?php 
include("../../config.php");

if(isset($_POST['artistId'])) {
    $artistId = $_POST['artistId'];

    $Query = mysqli_query($con, "SELECT * FROM artists WHERE id='$artistId'");
    $resultArray = mysqli_fetch_array($Query);

    echo json_encode($resultArray);
}


?>