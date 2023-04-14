<!-- logic to search for a category and return the given table  -->
<?php

//request category from table
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
    $category = $link->real_escape_string($_GET['category']);
    $query = "SELECT * FROM items WHERE category LIKE '%$category%' AND username != '$username'";

    //If clicked on button , order by price
    if(isset($_GET['expensive'])){
        $query .= " ORDER BY price DESC";
    }else{
        $query .= " ORDER BY post_date DESC";
    }

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
        //button that shows most expensive item
        echo "<div style='text-align:center;margin-top:10px;'>";
        echo "<form method='get'>";
        echo "<input type='hidden' name='category' value='$category'>";
        echo "<button type='submit' name='expensive'>Sort by Price (Descending)</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    } else {
        //else no items found pertaining to that category
        echo "<p style='text-align: center;'>No items found for \"$category\"</p>";
    }
}
?>
