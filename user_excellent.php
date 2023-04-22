<!-- List a user pair (A, B) such that they always gave each other "excellent" reviews for every single
item they posted. -->

<!-- current query should only return amanda and john -->


<!DOCTYPE html>
<html>

<head>
    <title>Users who only gave each other excellent reviews </title>
</head>

<body>
    <form method="GET" style="text-align:center; padding-top: 25px;">
        <button type="submit" name="only_exc" style="font-size: 1.2em; padding: 20px 55px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black;">Users who only gave each other 'excellent' reviews</button>
    </form>
    <div id="exc">
        <!-- retrieve info -->
        <?php
if (isset($_GET['only_exc'])) {
    $sql = "SELECT t1.username AS user1, t2.username AS user2
            FROM (
              SELECT r.username, COUNT(DISTINCT r.item_id) AS reviewed_items, 
                     SUM(CASE WHEN r.rating = 'excellent' THEN 1 ELSE 0 END) AS excellent_ratings
              FROM reviews r
              GROUP BY r.username
              HAVING reviewed_items = excellent_ratings
            ) t1
            JOIN (
              SELECT r.username, COUNT(DISTINCT r.item_id) AS reviewed_items, 
                     SUM(CASE WHEN r.rating = 'excellent' THEN 1 ELSE 0 END) AS excellent_ratings
              FROM reviews r
              GROUP BY r.username
              HAVING reviewed_items = excellent_ratings
            ) t2 ON t1.username < t2.username";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        echo "<div style='display: flex; justify-content: center;'>";
        echo "<table style='border-collapse: collapse;'>";
        echo "<tr><th style='border: 1px solid black; padding: 5px;'>Users</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $user1 = $row["user1"];
            $user2 = $row["user2"];
            echo "<tr><td style='border: 1px solid black; padding: 5px;'>($user1, $user2)</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No users found who have given 'excellent' ratings to all the items they have reviewed.";
    }
}
?>



    </div>
</body>

</html>