<!-- search form -->
<h2 style="text-decoration: underline; text-align: center;">List all "Excellent" or "Good" rated items</h2>

<form style="
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 5px solid black;
    margin: 0 auto;
    max-width: 600px;
    padding: 20px;
    " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username" style="font-size: 20px;">Username:</label>
    <input type="text" id="username" name="username" style="font-size: 20px;" required><br><br>

    <input type="submit" value="Search User" style="font-size: 20px;">
</form>


<!--Retreive info-->
<!-- Items with only "Excellent" and "Good"-->
<?php

// Check if the form has been submitted
if (isset($_POST["username"])) {

    // Get the username from the items table
    $item_username = $link->real_escape_string($_POST['username']); // to prevent SQL injection
    $sql = "SELECT id FROM items WHERE username = '$item_username'";
    $result = $link->query($sql);

    // Get the ids associated with the username
    $item_ids = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item_ids[] = $row["id"];
        }
    }

    // Build the query to fetch the items that meet the criteria
    $sql = "SELECT DISTINCT items.title FROM items
            INNER JOIN reviews ON items.id = reviews.item_id
            WHERE items.id IN (" . implode(",", $item_ids) . ")
            AND reviews.rating IN ('excellent', 'good')
            AND items.id NOT IN (
                SELECT item_id FROM reviews
                WHERE rating IN ('fair', 'poor')
            )";

    // Execute the query
    $result = $link->query($sql);


    // Output the results
    //  Use: neil, items 2(ipad/poor, excellent,good) and 6(google pixel 6/good, exccelent) | gary, items 4(Apple TV/excellent, excellent) and 5(Samsung 23/poor) | rick for no items with good or excellent ratings.

    if (mysqli_num_rows($result) > 0) {
        echo "<h2 style='text-align: center; text-decoration: underline;'>Items with only excellent or good rating belonging to user " . $item_username . "</h2>";
        echo "<div style='margin: 0 auto; max-width: 800px;'>";
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #ddd;'><th style='padding: 10px; border: 1px solid #000;'>Item</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td style='padding: 10px; border: 1px solid #000;'>" . $row["title"] . "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p style='text-align: center;'>No items found with only excellent or good rating belonging to user " . $item_username . ".</p>";
    }
}

?>