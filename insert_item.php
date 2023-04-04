<html style="background-color: #EDF2F7;" ;>

<body>

<?php
include 'connection.php';
?>


<div>
    <h1>
        This is the insert item page
    </h1>
</div>

    <?php




    // // Connect to the MySQL database
    // $servername = "localhost";
    // $username = "username";
    // $password = "password";
    // $dbname = "myDB";
    // $conn = new mysqli($servername, $username, $password, $dbname);

    // // Check connection
    // if ($conn->connect_error) {
    //   die("Connection failed: " . $conn->connect_error);
    // }

    // // Get the username from the session or from a cookie
    // $username = $_SESSION["username"];

    // // Check if the user has already posted three items today
    // $sql = "SELECT COUNT(*) as count FROM posts WHERE username='$username' AND post_date=CURDATE()";
    // $result = $conn->query($sql);
    // $row = $result->fetch_assoc();
    // $count = $row["count"];
    // if ($count >= 3) {
    //   echo "You have already posted three items today.";
    //   exit;
    // }

    // // Get the item details from the form
    // $title = $_POST["title"];
    // $description = $_POST["description"];
    // $category = $_POST["category"];
    // $price = $_POST["price"];

    // // Validate the data
    // if (empty($title) || empty($description) || empty($category) || empty($price)) {
    //   echo "Please fill in all required fields.";
    //   exit;
    // }
    // if (!is_numeric($price)) {
    //   echo "Price must be a number.";
    //   exit;
    // }

    // // Insert the item into the database
    // $sql = "INSERT INTO items (title, description, category, price) VALUES ('$title', '$description', '$category', '$price')";
    // if ($conn->query($sql) === TRUE) {
    //   echo "Item inserted successfully.";
    // } else {
    //   echo "Error inserting item: " . $conn->error;
    // }

    // // Insert the post into the posts table
    // $sql = "INSERT INTO posts (username, post_date) VALUES ('$username', CURDATE())";
    // $conn->query($sql);

    // $conn->close();

    ?>

</body>

</html>