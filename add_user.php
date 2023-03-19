<html style= "background-color: #EDF2F7;";>
	<body>
		<?php
			include 'connection.php';
			//take in the submission for each entry
			$username = $_REQUEST["username"];
			$password = $_REQUEST["password"];		
			$firstName = $_REQUEST["firstName"];
			$lastName = $_REQUEST["lastName"];
			$email = $_REQUEST["email"];
			
			//Query conatining all usernames in database
			$userSQL = "SELECT * FROM user WHERE username = ?";	
			$userSt = $link->prepare($userSQL);			
			$userSt->bind_param("s", $username);	
			$userSt->execute();			
			$userResult = $userSt->get_result();

            //Query contining all emails in database
            $emailSQL = "SELECT * FROM user WHERE email = ?";	
			$emailSt = $link->prepare($emailSQL);			
			$emailSt->bind_param("s", $email);	
			$emailSt->execute();			
			$emailResult = $emailSt->get_result();


			//Check if an email or username is already taken
			if (mysqli_num_rows($userResult) > 0 || mysqli_num_rows($emailResult) > 0)
			{?>

                <table style="
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0 auto;
                    ">
                        <tr>
                            <td>
				<h1 style= "color:red;">Username or Email already taken.</h1><h3>Choose another Username/Email.</h3>
				<form method="post" action="login_signup.php">
					<p><input type="submit" value="Return"></p>
				</form>

                </td>
                        </tr>
                        </table>
			<?php
			}
			else 
			{
			
			//Otherwise insert the new entries into the database			
			$addUserQuery = "INSERT INTO user (username, password, firstName, lastName, email)
							VALUES ('$username', '$password', '$firstName', '$lastName', '$email')";
														
			//Confirmation that the query was added					
			if (mysqli_query($link, $addUserQuery)) 
				{
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
					<h1> Succesfully Registered as <?php echo $username; ?>! </h1>
					<form method="post" action="login_signup.php">
						<p><input type="submit" value="Return"></p>
					</form>

                    </td>
                        </tr>
                        </table>
				<?php
				} 
				else 
				{?>
					<!-- error adding user -->
					<h1>Error adding user</h1>
				<?php
				die(mysqli_error($link) . "</body> Try again.</html>"); //prompt to try again
				}
			}
				?>	
						
		<?php
			//the database is closed
			$link->close();
		?>	
	</body>
</html>