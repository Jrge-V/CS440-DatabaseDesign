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
    <!-- insert form -->
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

    <!-- search form -->
    <h2>Search Items by Category</h2>
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br><br>
        <input type="submit" value="Search">
    </form>

    <!-- form for submitting a review -->
    <h2>Submit a Review</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="rating">Rating:</label>
        <select id="rating" name="rating">
            <option value="excellent">Excellent</option>
            <option value="good">Good</option>
            <option value="fair">Fair</option>
            <option value="poor">Poor</option>
        </select><br><br>

        <label for="review">Review:</label>
        <textarea id="review" name="review" required></textarea><br><br>

        <label for="item_id">Item ID:</label>
        <input type="number" id="item_id" name="item_id" required><br><br>

        <input type="submit" value="Submit Review">
    </form>


    <!-- logic to submit a post  -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {
        // check for 3 posts per day
        $result = $link->query("SELECT COUNT(*) FROM items WHERE username='$username' AND DATE(post_date) = CURDATE()");
        $count = $result->fetch_row()[0];
        if ($count >= 3) {
            echo "<p>You have already posted 3 items today. Please try again tomorrow.</p>";
        } else {
            // gather the values in the insert item form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $price = $_POST['price'];

            // sanitize for SQL injections
            $title = $link->real_escape_string($title);
            $description = $link->real_escape_string($description);
            $category = $link->real_escape_string($category);
            $price = $link->real_escape_string($price);

            // insert item into 'items' table
            $query = "INSERT INTO items (title, description, category, price, username) VALUES ('$title', '$description', '$category', '$price', '$username')";

            if ($link->query($query) === TRUE) {
                echo "<p>Item added successfully!</p>";
            } else {
                echo "<p>Error adding item: " . $link->error . "</p>";
            }
        }
    }

    ?>

    <!-- logic to search for a category and return the given table  -->
    <?php

    //request category from table
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
        $category = $link->real_escape_string($_GET['category']);
        $query = "SELECT * FROM items WHERE category LIKE '%$category%' AND username != '$username' ORDER BY post_date DESC";

        $result = $link->query($query);
        //display category if found
        if ($result->num_rows > 0) {
            echo "<h2>Search Results for \"$category\"</h2>";
            echo "<table>";
            echo "<tr><th>Item ID</th><th>Title</th><th>Description</th><th>Category</th><th>Price</th><th>By User:</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] .  $row["title"] . "</td><td>" . $row["description"] . "</td><td>" . $row["category"] . "</td><td>" . $row["price"] . "</td><td>" . $row["username"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            //else no items found pertaining to that category
            echo "<p>No items found for \"$category\"</p>";
        }
    }
    ?>


<?php
    // logic to submit a review
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rating']) && isset($_POST['review']) && isset($_POST['item_id'])) {
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $item_id = $_POST['item_id'];
    
        // sanitize for SQL injections
        $rating = $link->real_escape_string($rating);
        $review = $link->real_escape_string($review);
        $item_id = $link->real_escape_string($item_id);
        $username = $link->real_escape_string($username);

        // get the current datetime in the format 'YYYY-MM-DD HH:MM:SS'
        $post_date = date('Y-m-d H:i:s');
    
        // count the number of reviews submitted by the user in the last 24 hours
        $result = $link->query("SELECT COUNT(*) FROM reviews WHERE username='$username' AND post_date >= DATE_SUB(NOW(), INTERVAL 1 DAY)");
        $count = $result->fetch_row()[0];

        // check if the user has submitted 3 or more reviews in the last 24 hours
        if ($count >= 3) {
            echo "<p>You have exceeded the maximum number of reviews per day.</p>";
        } else {
            // insert review into 'reviews' table
            $query = "INSERT INTO reviews (item_id, username, rating, review, post_date) VALUES ('$item_id', '$username', '$rating', '$review', '$post_date')";
            if ($link->query($query) === TRUE) {
                echo "<p>Review submitted successfully!</p>";
            } else {
                echo "<p>Error submitting review: " . $link->error . "</p>";
            }
        }
    }

    include 'reviews.php';
    // close database connection
    $link->close();

    
?>





</body>

</html>