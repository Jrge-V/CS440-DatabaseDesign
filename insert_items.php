<html style="background-color: #EDF2F7;">
  <body>
    <?php
    include 'connection.php';
    // check if session has already been started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // access the previous session when user logged in!
    $username = $_SESSION["username"];

    //Display welcome message with username
    echo "<h1>Welcome, $username!</h1>";

    //Close database
    $link->close();
    ?>
  </body>
</html>
