<!-- Display all the users who never posted any items with reviews that have at least 3 ratings as 'excellent' -->

<!-- with current query, should return everyone except joe, since joe's item 3 has at least 3 excellent-->

<!DOCTYPE html>
<html>

<head>
    <title>List users with no items with 3 excellent reviews</title>
</head>

<body>
    <form method="GET" style="text-align:center; padding-top: 25px;">
        <button type="submit" name="list_users_no_exc" style="font-size: 1.2em; padding: 20px 55px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black;">Users with no item having at least 3 excellent reviews</button>
    </form>
    <div id="list_all_user">
        <!-- retrieve info -->
        <?php
        if (isset($_GET['list_users_no_exc'])) {
            $sql = "SELECT DISTINCT username FROM items WHERE username NOT IN (
        SELECT DISTINCT i.username FROM items i
        JOIN reviews r ON i.id = r.item_id
        WHERE r.rating = 'excellent'
        GROUP BY i.id
        HAVING COUNT(CASE WHEN r.rating = 'excellent' THEN 1 END) >= 3
    )";

            $result = $link->query($sql);

            if ($result->num_rows > 0) {
                echo "<div style='display: flex; justify-content: center;'>";
                echo "<table style='border-collapse: collapse;'>";
                echo "<tr><th style='border: 1px solid black; padding: 5px;'>Usernames:</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td style='border: 1px solid black; padding: 5px;'>" . $row["username"] . "</td></tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "All users have posted items with at least 3 excellent reviews.";
            }
            
        }
        ?>

    </div>
</body>

</html>