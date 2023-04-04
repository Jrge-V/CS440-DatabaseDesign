<html style="background-color: #EDF2F7;">

<body>
	<?php
	include 'connection.php';
	// check if session has already been started
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	//access to values submitted
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	//get username
	$userSQL = "SELECT * FROM user WHERE username = ?";
	$userSt = $link->prepare($userSQL);
	$userSt->bind_param("s", $username);
	$userSt->execute();
	$userResult = $userSt->get_result();

	//get password
	$passSQL = "SELECT * FROM user WHERE password = ?";
	$passSt = $link->prepare($passSQL);
	$passSt->bind_param("s", $password);
	$passSt->execute();
	$passwordResult = $passSt->get_result();

	//match accounts
	if ((mysqli_num_rows($userResult) > 0) && (mysqli_num_rows($passwordResult) > 0)) {
		$_SESSION["username"] = $username;
	?>

		<table style="
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0 auto;
                    ">
			<tr>
				<td>

					<br>
					<h1 style="text-decoration: underline;"> Welcome back <?php echo "" . $username; ?> </h1>
					<!--return button-->
					<div style="margin-top: 2rem; text-align: center;">
						<form method="post" action="login_signup.php" style="display: inline-block;">
							<button type="submit" style="margin-right: 20px; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem; font-weight: 600; border-radius: 0.5rem; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.25); color: white; background-color: #4B5563; transition: background-color 0.2s ease-in-out; outline: none; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#374151'" onmouseout="this.style.backgroundColor='#4B5563'">Return</button>
						</form>
						<!--continue button-->
						<form method="post" action="insert_items.php" style="display: inline-block;">
							<button type="submit" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem; font-weight: 600; border-radius: 0.5rem; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.25); color: white; background-color: #00CB04; transition: background-color 0.2s ease-in-out; outline: none; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#007C02'" onmouseout="this.style.backgroundColor='#00CB04'">Continue</button>
						</form>
					</div>



				</td>
			</tr>
		</table>
	<?php
	}

	//account info doesn't match
	if ((mysqli_num_rows($userResult) > 0) && (!(mysqli_num_rows($passwordResult) > 0))) { ?>
		<table style="
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0 auto;
                    ">
			<tr>
				<td>

					<br>
					<h1 style="color: red" ;> ERROR: MISMATCH BETWEEN USERNAME AND PASSWORD!</h1>
					<h3> Return and try again.</h3>

					<!--return button-->
					<div style="margin-top: 2rem; text-align: center;">
						<form method="post" action="login_signup.php">
							<button type="submit" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem; font-weight: 600; border-radius: 0.5rem; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.25); color: white; background-color: #4B5563; transition: background-color 0.2s ease-in-out; outline: none; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#374151'" onmouseout="this.style.backgroundColor='#4B5563'">Return</button>

						</form>
					</div>

				</td>
			</tr>
		</table>
	<?php
	}
	//username not in system
	if (!(mysqli_num_rows($userResult) > 0)) { ?>
		<table style="
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0 auto;
                    ">
			<tr>
				<td>
					<br><br>
					<h1 style="color: red" ;> ERROR: USER NOT FOUND</h1>
					<h3> Return to Sign up or check credentials.</h3>

					<!--return button-->
					<div style="margin-top: 2rem; text-align: center;">
						<form method="post" action="login_signup.php">
							<button type="submit" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem; font-weight: 600; border-radius: 0.5rem; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.25); color: white; background-color: #4B5563; transition: background-color 0.2s ease-in-out; outline: none; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#374151'" onmouseout="this.style.backgroundColor='#4B5563'">Return</button>

						</form>
					</div>
				</td>
			</tr>
		</table>
	<?php
	}

	//Close database
	$link->close();
	?>
</body>

</html>