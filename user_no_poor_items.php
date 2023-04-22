<!-- display all users who have items that have never received a 'poor' review or no reviews at all -->
<!-- current query, should only display amanda -->

<!DOCTYPE html>
<html>

<head>
    <title>List users with NO 'poor' items</title>
</head>

<body>
    <form method="GET" style="text-align:center; padding-top: 25px;">
        <button type="submit" name="no_poor_items" style="font-size: 1.2em; padding: 20px 55px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black;">Users with no poor reviewed items</button>
    </form>
    <div id="none_poor">
        <!-- retrieve info -->
        <?php
        if (isset($_GET['no_poor_items'])) {
            $sql = "SELECT i.username FROM items i 
                    LEFT JOIN reviews r ON r.item_id = i.id AND r.rating = 'poor'
                    GROUP BY i.username
                    HAVING COUNT(DISTINCT CASE WHEN r.rating = 'poor' THEN r.item_id END) = 0 OR COUNT(DISTINCT r.item_id) = (SELECT COUNT(*) FROM items)";
        
            $result = $link->query($sql);
        
            if ($result->num_rows > 0) {
                echo "<div style='display: flex; justify-content: center;'>";
                echo "<table style='border-collapse: collapse;'>";
                echo "<tr><th style='border: 1px solid black; padding: 5px;'>Users</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td style='border: 1px solid black; padding: 5px;'>" . $row["username"] . "</td></tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "No users found with ONLY poor reviweed items";
            }
        }
        
        ?>

    </div>
</body>

</html>