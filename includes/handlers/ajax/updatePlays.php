<?php 
include("../../config.php");

if(isset($_POST['songId'])) {
    $songId = $_POST['songId'];

    $Query = mysqli_query($con, "UPDATE songs SET plays = plays+1 WHERE id='$songId'");
    $resultArray = mysqli_fetch_array($Query);

    echo json_encode($resultArray);

}


?>