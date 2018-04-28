<?php
    include("../../config.php");

    if(!isset($_POST['username'])) {
        echo "You must provide an username!";
        exit();
    }

        // $emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email' AND username != '$username'");

        // if(mysqli_num_rows($emailCheck) > 0) {
        //     echo "Email is already in use!";
        //     exit();
        // }

        // $updateQuery = mysqli_query($con, "UPDATE users SET email='$email' WHERE username='$username'");
        //     echo "Successfully Updated Your Email.";

    
    if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])) {
        echo "Not all passwords have been set";
        exit();
    }
    
    if($_POST['oldPassword'] =="" || $_POST['newPassword1']=="" || $_POST['newPassword2']=="") {
        echo "Please fill in all fields";
        exit();
    }

    $username = $_POST['username'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword1 = $_POST['newPassword1'];
    $newPassword2 = $_POST['newPassword2'];

    $oldMd5 = md5($oldPassword);

    $passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' AND password='$oldMd5'");
    if(mysqli_num_rows($passwordCheck) != 1) {
        echo "Your password is not correct!";
        exit();
    }
    
    if($newPassword1 != $newPassword2) {
        echo "New passwords do not match!";
        exit();
    }

    if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
        echo "Your password can only contain numbers and letters!";
        exit();
    }    

    if(strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
        echo "You password must be between 5 and 30 characters";
        exit();
    }

    $newMd5 =md5($newPassword1);
    $updateQuery = mysqli_query($con, "UPDATE users SET password='$newMd5' WHERE username='$username'");
    echo "Successfully Updated Your Password";

?>