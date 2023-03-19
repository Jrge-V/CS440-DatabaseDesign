<html style="background-color: #EDF2F7;" ;>

<body>
	<?php
	include 'connection.php';

	$page = "base";
	if (isset($_REQUEST["page"])) {
		$page = $_REQUEST["page"];
		settype($page, "string");
	} else {
		$page = "home";
	}

	if ($page == "home") {
	?>

		<h1 style="text-align:center; text-decoration: underline; ">COMP 440</h1>
		<table style="
        margin-left: auto;
        margin-right: auto;
        border: 5px solid black;
        ">
			<tr>
				<td>
					<h2>Log in</h2>
					<form method="post" action="main_page.php">
						<label>USERNAME:
							<input type="text" name="username" maxlength="15" pattern="^\S{1,}$" required oninvalid='this.setCustomValidity("Required field | Do not include spaces")' oninput="this.setCustomValidity('')">
						</label>
						<br><br>
						<label>PASSWORD:
							<input type="password" name="password" maxlength="50" pattern="^\S{1,}$" required oninvalid='this.setCustomValidity("Required field | Do not include spaces")' oninput="this.setCustomValidity('')">
						</label>
						<br><br>
						<!-- Login button -->
						<div style="text-align: center;">
						<input type="submit" value="LOG IN" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">
						</div>
						<input type="hidden" name="page" value="home">
					</form>
				</td>
			</tr>
		</table>
		<br><br>

		<table style="
        margin-left: auto;
        margin-right: auto;
        border: 5px solid black;
        ">
			<tr>
				<td>
					<h2>Sign up</h2>
					<form method="post" action="add_user.php">
						<label>USERNAME:
							<input type="text" name="username" maxlength="15" pattern="^\S{1,15}$" required oninvalid='this.setCustomValidity("Required field | Do not include spaces")' oninput="this.setCustomValidity('')">
						</label>
						<br><br>

						<label>PASSWORD:
							<input id="password" name="password" type="password" pattern="^\S{1,}$" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Passwords must match | Do not include spaces' : '');
				if(this.checkValidity()) form.passwordMatching.pattern = this.value;" placeholder="Password" required>

							<input id="passwordMatching" name="passwordMatching" type="password" maxlength="50" pattern="^\S{1,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'PASSWORDS DO NOT MATCH | Do not include spaces' : '');
				" placeholder="Confirm Password" required>
						</label>

						<br><br>
						<label>FIRST NAME:
							<input type="text" name="firstName" maxlength="30">
						</label>
						<br><br>
						<label>LAST NAME:
							<input type="text" name="lastName" maxlength="30">
						</label>
						<br><br>
						<label>EMAIL:
							<input type="email" name="email" maxlength="50" pattern="^\S{1,}$" required oninvalid='this.setCustomValidity("Required field | Do not include spaces")' oninput="this.setCustomValidity('')">
						</label>
						<br><br>
						<!-- Submit button -->
						<div style="text-align: center;">
						<input type="submit" value="SUBMIT" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">
						</div>
						<input type="hidden" name="page" value="home">
					</form>
				</td>
			</tr>
		</table>



	<?php

	} else {
		$username = $password = $firstName = $lastName = $email = "";
		if (
			isset($_REQUEST["username"]) && $_REQUESt["username"] != ""
			&& isset($_REQUEST["password"]) && $_REQUEST["password"] != ""
			&& isset($_REQUEST["firstName"]) && $_REQUEST["firstName"] != ""
			&& isset($_REQUEST["lastName"]) && $_REQUEST["lastName"] != ""
			&& isset($_REQUEST["email"]) && $_REQUEST["email"] != ""
		) {
			$username = $_REQUEST["username"];
			$password = $_REQUEST["password"];
			$firstName = $_REQUEST["firstName"];
			$lastName = $_REQUEST["lastName"];
			$email = $_REQUEST["email"];
		}
	}
	?>
	<br>

	<!--return button-->
	<div style="margin-top: 2rem; text-align: center;">
		<form method="post" action="init_db.php">
			<button type="submit" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem; font-weight: 600; border-radius: 0.5rem; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.25); color: white; background-color: #4B5563; transition: background-color 0.2s ease-in-out; outline: none; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#374151'" onmouseout="this.style.backgroundColor='#4B5563'">Return</button>

		</form>
	</div>

</body>

</html>