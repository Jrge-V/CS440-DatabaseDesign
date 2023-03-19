<?php
include 'connection.php';

if (isset($_POST['init_db'])) {
	include 'sql.php';
}

?>
<html style="background-color: #EDF2F7;">
<!-- Initial page -->

<head>
</head>

<body>

	<form method="post" action="#" style="text-align:center;">
		<p>
		<h1 style="text-decoration: underline;"> Initialize Database:</h1>
		</p>
		<input type="submit" name="init_db" value="Initialize or Reset DB!" onclick="showAlert()" style="font-size: 1.2em; padding: 20px 20px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black; margin-bottom: 50px;" />
	</form>

	<script>
		function showAlert() {
			window.alert("Database has been initialized!");
		}
	</script>


	<!-- Check Table -->
	<form method="post" action="user_table.php" style="text-align:center;">
		<p>
			<input type="submit" value="Check User Table" style="font-size: 1.2em; padding: 20px 40px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black; margin-bottom: 50px;">
		</p>
	</form>

	<!-- Login/Signup -->
	<form method="post" action="login_signup.php" style="text-align:center;">
		<p>
			<input type="submit" value="Login/Sign Up" style="font-size: 1.2em; padding: 20px 55px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black;">
		</p>
	</form>

</body>

</html>