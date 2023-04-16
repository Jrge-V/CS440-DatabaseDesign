<!-- search form -->
<h2 style="text-decoration: underline; text-align: center;">Search for users who posted an item on the same day</h2>

<form style="
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 5px solid black;
    margin: 0 auto;
    max-width: 600px;
    padding: 20px;
    " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="category1" style="font-size: 20px;">Category 1:</label>
    <input type="text" id="category1" name="category1" style="font-size: 20px;" required><br><br>

    <label for="category2" style="font-size: 20px;">Category 2:</label>
    <input type="text" id="category2" name="category2" style="font-size: 20px;" required><br><br>

    <input type="submit" value="Search Categories" style="font-size: 20px;">
</form>



<?php
// check if session has already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// retrieve items posted by different users on the same day for both categories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category1']) && isset($_POST['category2'])) {
    $category1 = $link->real_escape_string($_POST['category1']);
    $category2 = $link->real_escape_string($_POST['category2']);

    $query = "SELECT i1.username, i2.username AS username2 FROM items i1
    JOIN items i2 ON DATE(i1.post_date) = DATE(i2.post_date) AND i1.username != i2.username
    WHERE i1.category='$category1' AND i2.category='$category2'
    AND i1.username IN (SELECT username FROM items WHERE category='$category1')
    AND i2.username IN (SELECT username FROM items WHERE category='$category2')
    GROUP BY LEAST(i1.username, i2.username), GREATEST(i1.username, i2.username), DATE(i1.post_date)";

    $result = $link->query($query);
    // display items if found
    if ($result->num_rows > 0) {
        echo "<h2 style='text-align: center; text-decoration: underline;'>Users who posted items in categories $category1 and $category2 on the same day</h2>";
        echo "<div style='margin: 0 auto; max-width: 800px;'>";
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #ddd;'><th style='padding: 10px; border: 1px solid #000;'>Username 1</th><th style='padding: 10px; border: 1px solid #000;'>Username 2</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td style='padding: 10px; border: 1px solid #000;'>" . $row["username"] . "</td><td style='padding: 10px; border: 1px solid #000;'>" . $row["username2"] . "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p style='text-align: center;'>No items found posted on the same day in Categories $category1 and $category2.</p>";
    }
}
?>