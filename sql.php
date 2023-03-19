<?php
//no content on page, just used to connect to userinfo_cs.sql	
				$link = new PDO("mysql:host=127.0.0.1;
                dbname = userinfo_cs440",'root', '');
				$select = $link->query(file_get_contents("C:xampp\htdocs\comp440_06_part1\userinfo_cs440.sql"));
				while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				echo $row['username'].'<br>';
				}	

?>