<html>
	<body>
	<?php
		include 'connection.php';
		
			$page = "base";
			if(isset($_REQUEST["page"]))
			{
				$page = $_REQUEST["page"];
				settype($page, "string");
			}
			else
			{
				$page = "home";
			}
		
		if($page == "home")
		{
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
			<form method = "post" action = "main_page.php">			
				<label>USERNAME: 
					<input type="text" name="username">
				</label>
                <br><br>
				<label>PASSWORD:
					<input type="password" name="password">
				</label>
                <br><br>
				<input type="submit" value="LOG IN">
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
			<form method = "post" action = "add_user.php">
				<label>USERNAME:
					<input type="text" name="username" required>
				</label>
                <br><br>

				<label>PASSWORD:
				<input id="password" name="password" type="password" pattern="^\S{1,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Passwords must match' : '');
				if(this.checkValidity()) form.passwordMatching.pattern = this.value;" placeholder="Password" required>

				<input id="passwordMatching" name="passwordMatching" type="password" pattern="^\S{1,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'PASSWORDS DO NOT MATCH' : '');
				" placeholder="Confirm Password" required>
				</label>

                <br><br>		
				<label>FIRST NAME:
					<input type="text" name="firstName">
				</label>
                <br><br>
				<label>LAST NAME:
					<input type="text" name="lastName">
				</label>
                <br><br>
				<label>EMAIL:
					<input type="email" name="email" required>
				</label>
                <br><br>
				<input type="submit" value="SUBMIT">
				<input type="hidden" name="page" value= "home">
			</form>
                </td>
            </tr>
        </table>
        
		
			
		<?php
		
			} else
			{
				$username = $password = $firstName = $lastName = $email = "";
				if (isset($_REQUEST["username"]) && $_REQUESt["username"] != "" 
				&& isset($_REQUEST["password"])&& $_REQUEST["password"] != ""
				&& isset($_REQUEST["firstName"])&& $_REQUEST["firstName"] != ""
				&& isset($_REQUEST["lastName"])&& $_REQUEST["lastName"] != ""
				&& isset($_REQUEST["email"])&& $_REQUEST["email"] != "")
					
				{
					$username = $_REQUEST["username"];
					$password = $_REQUEST["password"];
					$firstName = $_REQUEST["firstName"];
					$lastName = $_REQUEST["lastName"];
					$email = $_REQUEST["email"];
				}		
			}
		?>
<br>
	</body>
</html>