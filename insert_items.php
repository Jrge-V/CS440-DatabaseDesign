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
    <h2 style="text-align: center; text-decoration: underline;">Insert Item</h2>

    <form style="
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 5px solid black;
    margin: 0 auto;
    max-width: 600px;
    padding: 20px;
    " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" style="font-size: 18px;" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" style="font-size: 18px;" required></textarea><br><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" style="font-size: 18px;" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step=".01" style="font-size: 18px;" required><br><br>

        <input type="submit" value="Submit">
    </form>


    <div style=" display: flex;
    flex-direction: column;
    align-items: center;
    border: 5px solid black;
    margin: 0 auto;
    max-width: 600px;
    padding: 20px; ">

        <!-- search form -->
        <h2 style="text-decoration: underline;">Search Items by Category</h2>

        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="category" style="font-size: 1.2em;">Category:</label>
            <input type="text" id="category" name="category" required style="font-size: 1.2em;"><br><br>
            <input type="submit" value="Search" style="font-size: 1.2em;">
        </form>

        <!-- form for submitting a review -->
        <h2 style="text-decoration: underline;">Submit a Review</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="rating" style="font-size: 1.2em;">Rating:</label>
            <select id="rating" name="rating" style="font-size: 1.2em;">
                <option value="excellent">Excellent</option>
                <option value="good">Good</option>
                <option value="fair">Fair</option>
                <option value="poor">Poor</option>
            </select><br><br>

            <label for="review" style="font-size: 1.2em;">Review:</label>
            <textarea id="review" name="review" required style="font-size: 1.2em;"></textarea><br><br>

            <label for="item_id" style="font-size: 1.2em;">Item ID:</label>
            <input type="number" id="item_id" name="item_id" required style="font-size: 1.2em;"><br><br>

            <input type="submit" value="Submit Review" style="font-size: 1.2em;">
        </form>

    </div>



    <!-- logic to insert an item  -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {
        // check for 3 posts per day
        $result = $link->query("SELECT COUNT(*) FROM items WHERE username='$username' AND DATE(post_date) = CURDATE()");
        $count = $result->fetch_row()[0];
        if ($count >= 3) {
            echo "<p>Max items posted per day (3).</p>";
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
            echo "<h2 style='text-align: center;'>Search Results for \"$category\"</h2>";
            echo "<div style='margin: 0 auto; max-width: 800px;'>";
            echo "<table style='border-collapse: collapse; width: 100%;'>";
            echo "<tr style='background-color: #ddd;'><th style='padding: 10px; border: 1px solid #000;'>Item ID</th><th style='padding: 10px; border: 1px solid #000;'>Title</th><th style='padding: 10px; border: 1px solid #000;'>Description</th><th style='padding: 10px; border: 1px solid #000;'>Category</th><th style='padding: 10px; border: 1px solid #000;'>Price</th><th style='padding: 10px; border: 1px solid #000;'>By User:</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td style='padding: 10px; border: 1px solid #000;'>" . $row["id"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["title"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["description"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["category"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["price"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["username"] . "</td></tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            //else no items found pertaining to that category
            echo "<p style='text-align: center;'>No items found for \"$category\"</p>";
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

<?php

// logout
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login_signup.php');
}

?>

<div style="text-align:center; padding: 20px;">
    <form method="post">
        <button style="background-color:red; color:white; font-size:25px; cursor:pointer;
        " type="submit" name="logout">Logout</button>
    </form>
</div>