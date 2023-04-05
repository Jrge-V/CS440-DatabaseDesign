<!-- search form -->
<h2>Search Reviews by Item ID</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="item_id">Item ID:</label>
    <input type="number" id="item_id" name="item_id" required><br><br>
    <input type="submit" value="Search">
</form>

<?php

// check if session has already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// access the previous session when user logged in!
$username = $_SESSION["username"];

// retrieve reviews for a specific item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = $link->real_escape_string($_POST['item_id']);
    $query = "SELECT * FROM reviews WHERE item_id='$item_id'";

    $result = $link->query($query);
    // display reviews if found
    if ($result->num_rows > 0) {
        echo "<h2>Reviews for item #$item_id</h2>";
        echo "<table>";
        echo "<tr><th>Rating</th><th>Review</th><th>By User</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["rating"] . "</td><td>" . $row["review"] . "</td><td>" . $row["username"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No reviews found for item #$item_id.</p>";
    }
}
?>

