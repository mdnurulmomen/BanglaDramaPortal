
<?php session_start(); session_unset(); session_destroy(); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Bangla Drama Login</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100 p-t-190 p-b-30">
					<form class="login100-form validate-form" action="loginValidation.php" method="POST">
						<div class="login100-form-avatar">
							<img src="images/avatar-01.jpg" alt="AVATAR">
						</div>

						<span class="login100-form-title p-t-20 p-b-45">
							Bangla Drama Login
						</span>

						<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
							<input class="input100" type="text" name="userName" placeholder="User Name" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
							<input class="input100" type="password" name="userPsw" placeholder="Password" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						
						<div class="wrap-input100 validate-input m-b-10">
						<?php
							if(isset($_REQUEST['Message'])){ ?>
							<p style="color:red; text-align: center;"><?php echo $_REQUEST['Message'] ;?></p>
						<?php
							}
						?>
						</div>
						
						<div class="container-login100-form-btn p-t-10">
							<button type="submit" name="login" value="login" class="login100-form-btn">
								Login
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>