<?php
include 'connection.php';


// check if session has already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// access the previous session when user logged in!
$username = $_SESSION["username"];
?>
<div>
    <h1>
        Logged in as <?php echo $username; ?>
    </h1>
</div>


<!DOCTYPE html>
<html style="background-color: #EDF2F7;">

<head>
    <title>Insert Item</title>
</head>

<body>
    <h2>Insert Item</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step=".01" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <h2>Search Items by Category</h2>
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br><br>
        <input type="submit" value="Search">
    </form>


    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {
        // check if user has already posted 3 items today
        $result = $link->query("SELECT COUNT(*) FROM items WHERE username='$username' AND DATE(post_date) = CURDATE()");
        $count = $result->fetch_row()[0];
        if ($count >= 3) {
            echo "<p>You have already posted 3 items today. Please try again tomorrow.</p>";
        } else {
            // get input values from form submission
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $price = $_POST['price'];

            // sanitize input values to prevent SQL injection
            $title = $link->real_escape_string($title);
            $description = $link->real_escape_string($description);
            $category = $link->real_escape_string($category);
            $price = $link->real_escape_string($price);

            // insert item into items table
            $query = "INSERT INTO items (title, description, category, price, username) VALUES ('$title', '$description', '$category', '$price', '$username')";

            if ($link->query($query) === TRUE) {
                echo "<p>Item added successfully!</p>";
            } else {
                echo "<p>Error adding item: " . $link->error . "</p>";
            }
        }
    }

    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
        $category = $link->real_escape_string($_GET['category']);
        $query = "SELECT * FROM items WHERE category LIKE '%$category%' ORDER BY post_date DESC";
        $result = $link->query($query);

        if ($result->num_rows > 0) {
            echo "<h2>Search Results for \"$category\"</h2>";
            echo "<table>";
            echo "<tr><th>Title</th><th>Description</th><th>Category</th><th>Price</th><th>By User:</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["title"] . "</td><td>" . $row["description"] . "</td><td>" . $row["category"] . "</td><td>" . $row["price"] . "</td><td>" . $row["username"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No items found for \"$category\"</p>";
        }
    }


    // close database connection
    $link->close();
    ?>



</body>

</html>