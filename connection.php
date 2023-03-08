<?php

session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "userinfo_cs440";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname) or die("unable to connect");

//error handling
if(mysqli_connect_error()){
    die("Databse connection error: " . mysqli_connect_error());
}
//if success, show connection 
else{
    echo "Connected Successfully";
}

?>
