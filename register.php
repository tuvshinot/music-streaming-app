<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");
	$account = new Account($con); // that comes from config.php
	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");
	
	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>New User Spotify</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form action="register.php" id="loginForm" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed);?>
						<label for="loginUsername">Username</label>
						<input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. bartSimpson" required value="<?php getInputValue('loginUsername')?>">
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input name="loginPassword" type="password" id="loginPassword" placeholder="Your password" required>
					</p>
					<button type="submit" name="loginButton">Log in</button>
					<div class="hasAccountText">
						<span id="hideLogin">Don`t have an account yet? Signup here.</span>
					</div>
				</form>

				<form action="register.php" id="registerForm" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters);?>
						<?php echo $account->getError(Constants::$usernameTaken);?>
						<label for="username">Username</label>
						<input type="text" id="username" name="username" placeholder="e.g. bartSimpson" required value="<?php getInputValue('username') ?>">
					</p>
					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters);?>	
						<label for="firstName">First Name</label>
						<input type="text" id="firstName" name="firstName" placeholder="e.g. Bart" required value="<?php getInputValue('firstName') ?>">
					</p>
					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters);?>	
						<label for="lastName">Last Name</label>
						<input type="text" id="lastName" name="lastName" placeholder="e.g. Simpson" required value="<?php getInputValue('lastName') ?>">
					</p>
					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch);?>	
						<?php echo $account->getError(Constants::$emailInvalid);?>	
						<?php echo $account->getError(Constants::$emailTaken);?>
						<label for="email">Email</label>
						<input type="email" id="email" name="email" placeholder="e.g. bart@gmail.com" required value="<?php getInputValue('email') ?>">
					</p>
					<p>
						<label for="email2">Confirm email</label>
						<input type="email" id="email2" name="email2" placeholder="e.g. bart@gmail.com" required value="<?php getInputValue('email2') ?>">
					</p>
					<p>
						<?php echo $account->getError(Constants::$passwordsDoNoMatch);?>	
						<?php echo $account->getError( Constants::$passwordNotAlphanumeric);?>
						<?php echo $account->getError(Constants::$passwordCharacters);?>

						<label for="password">Password</label>
						<input name="password" type="password" id="password" placeholder="Your password" required >
					</p>
					<p>
						<label for="password2">Confirm password</label>
						<input name="password2" type="password" id="password2" placeholder="Your password" required>

						<button type="submit" name="rigisterButton">SIGN UP</button>
						<div class="hasAccountText">
							<span id="hideRegister">Already have an account? Log in here.</span>
						</div>
				</form>
			</div>
			<div id="loginText">
				<h1>Get great music, right now </h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create your own palylists</li>
					<li>Follow artists to keep up date</li>
				</ul>
			</div>


		</div>
	</div>

	<script src="assets/js/register.js"></script>
	<?php
		if(isset($_POST['rigisterButton'])) {
			echo 
			'<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
		} else {
			echo 
			'<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
		}
	?>
	
</body>
</html>