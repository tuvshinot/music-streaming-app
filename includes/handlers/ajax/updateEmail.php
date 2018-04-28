<?php
    include("../../config.php");

    if(!isset($_POST['username'])) {
        echo "You must provide an username!";
        exit();
    }

    if(isset($_POST['email']) && $_POST['email'] != "") {
        $email = $_POST['email'];
        $username = $_POST['username'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Your email is invalid ";
            exit();
        }

        $emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email' AND username != '$username'");

        if(mysqli_num_rows($emailCheck) > 0) {
            echo "Email is already in use!";
            exit();
        }

        $updateQuery = mysqli_query($con, "UPDATE users SET email='$email' WHERE username='$username'");
            echo "Successfully Updated Your Email.";
    } else {
        echo "ERROR : You must provide an email address!";
    }
?>