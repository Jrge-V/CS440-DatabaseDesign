<!-- search form -->
<h2 style="text-decoration: underline; text-align: center; ">Search Reviews by Item ID</h2>
<form style="
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 5px solid black;
    margin: 0 auto;
    max-width: 600px;
    padding: 20px;
    " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="item_id" style="font-size: 20px;">Item ID:</label>
    <input type="number" id="item_id" name="item_id" style="font-size: 20px;" required><br><br>
    <input type="submit" value="Search" style="font-size: 20px;">
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
        echo "<h2 style='text-align: center; text-decoration: underline;'>Reviews for item #$item_id</h2>";
        echo "<div style='margin: 0 auto; max-width: 800px;'>";
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #ddd;'><th style='padding: 10px; border: 1px solid #000;'>Rating</th><th style='padding: 10px; border: 1px solid #000;'>Review</th><th style='padding: 10px; border: 1px solid #000;'>By User</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td style='padding: 10px; border: 1px solid #000;'>" . $row["rating"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["review"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["username"] . "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p style='text-align: center;'>No reviews found for item #$item_id.</p>";
    }
    
    
}
?>

