<?php 
    if(isset($_POST['loginButton'])) {
    //log in button press
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];
        
    // Log in function
        $result = $account->login($username, $password);

        if($result) {
            $_SESSION['userLoggedIn'] = $username;   
            header("Location: index.php");
        }
    }
?>
