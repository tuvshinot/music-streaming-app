<?php 
include("../../config.php");

if(isset($_POST['songId'])) {
    $songId = $_POST['songId'];

    $Query = mysqli_query($con, "SELECT * FROM songs WHERE id='$songId'");
    $resultArray = mysqli_fetch_array($Query);

    echo json_encode($resultArray);

}


?>