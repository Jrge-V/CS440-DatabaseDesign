<?php

session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "userinfo_cs440";

try {
    // Create connection
    $link = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (mysqli_connect_errno()) {
        throw new Exception("Failed to connect to database: " . mysqli_connect_error());
    }

    //if success, show connection 
    echo "Connected Successfully";
} catch (Exception $e) {
    // Handle exception (e.g. display error message, log error, etc.)
    echo "Error: " . $e->getMessage();
}

?>
