<?php

include("includes/config.php");
include("includes/classes/Constants.php");
include("includes/classes/Account.php");
$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SignUp and Login</title>
	<link rel="stylesheet" href="assets/styles/register.css">
</head>
<body>
	<div class="container" id="container">
		<div class="form-container sign-up-container">

			<form action="register.php" method="POST">
				<h1>Create Account</h1>
				<span>Enter your email for registration</span>

				<?php echo $account->getError(Constants::$usernameCharacters); ?>
				<?php echo $account->getError(Constants::$usernameTaken); ?>
				<input name="username" type="text" placeholder="username" value="<?php getInputValue('username') ?>" required>


				<?php echo $account->getError(Constants::$firstNameCharacters); ?>
				<input name="firstName" type="text" placeholder="firstname" value="<?php getInputValue('firstName') ?>" required>

				<?php echo $account->getError(Constants::$lastNameCharacters); ?>
				<input name="lastName" type="text" placeholder="lastName" value="<?php getInputValue('lastName') ?>" required>

				<!-- <input type="text" name="name" placeholder="Name"> -->

				<?php echo $account->getError(Constants::$emailInvalid); ?>
				<?php echo $account->getError(Constants::$emailTaken); ?>
				<input name="email" type="email" placeholder="email" value="<?php getInputValue('email') ?>" required>


				<input name="country" type="text" placeholder="country" value="<?php getInputValue('country') ?>" required>
				<!-- <input type="email" name="email" placeholder="Email"> -->


				<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
				<?php echo $account->getError(Constants::$passwordCharacters); ?>
				<input id="password" name="password" type="password" placeholder="Your password" required>

				<button type="submit" name="registerButton">Sign Up</button>

			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="register.php" method="POST">
				<h1>Sign In</h1>
				<?php echo $account->getError(Constants::$loginFailed); ?>
				<input type="text" name="loginUsername" placeholder="username" required>
				<input name="loginPassword" type="password" placeholder="Password" required>
				<button type="submit" name="loginButton">LOG IN</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>Please login with your info</p>
					<button class="ghost" id="signIn" onclick="SignInButtonClickHandler()">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hi, Join Us!</h1>
					<p>Enter your details</p>
					<button class="ghost" id="signUp" onclick="SignUpButtonClickHandler()">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');
		const signInForm = document.getElementsByClassName("sign-in-container")[0]
		const SignUpButtonClickHandler = () => {
			container.classList.add("right-panel-active");
			signInForm.classList.add("hide")
		}
		const SignInButtonClickHandler = () => {
			container.classList.remove("right-panel-active");
			signInForm.classList.remove("hide")
		}
	</script>

</body>
</html>
