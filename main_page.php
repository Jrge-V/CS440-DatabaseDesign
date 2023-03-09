<html style= "background:#c0c0c0";>
	<body>
		<?php
			include 'connection.php';
			//access to values submitted
			$username = $_REQUEST["username"];
			$password = $_REQUEST["password"];			
			//get username
			$userSQL= "SELECT * FROM user WHERE username = ?";	
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
				if ((mysqli_num_rows($userResult) > 0) && (mysqli_num_rows($passwordResult) > 0)) 
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

					<br><h1 style="text-decoration: underline;"> Successfully Logged in as <?php echo "". $username; ?> </h1>
                    <form method = "post" action = "login_signup.php">		
				<input type="hidden" name="page" value="home">
				<p><input type="submit" value="RETURN"></p>
			</form>	
                    

                    </td>
                        </tr>
                        </table>	
				<?php
				}	
					//account info doesn't match
					if ((mysqli_num_rows($userResult) > 0) && (!(mysqli_num_rows($passwordResult) > 0)))
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
                    
						<br><h1 style="color: red";> ERROR: MISMATCH BETWEEN USERNAME AND PASSWORD!</h1>
						<h3> Return and try again.</h3>	

                        <form method = "post" action = "login_signup.php">		
				<input type="hidden" name="page" value="home">
				<p><input type="submit" value="RETURN"></p>
			</form>	

                        </td>
                        </tr>
                        </table>			
					<?php	
					}
					//username not in system
					if (!(mysqli_num_rows($userResult) > 0))
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
                            <br><br>
                            <h1 style="color: red";> ERROR: USER NOT FOUND</h1>
						<h3> Return to Sign up or check credentials.</h3>	

                        <form method = "post" action = "login_signup.php">		
				<input type="hidden" name="page" value="home">
				<p><input type="submit" value="RETURN"></p>
			</form>	
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