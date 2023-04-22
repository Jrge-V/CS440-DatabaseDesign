<!-- Display all users who only have poor reviews -->
<!-- with the current query it should only display neil -->

<!DOCTYPE html>
<html>

<head>
    <title>List users with ONLY "Poor" reviews</title>
</head>

<body>
    <form method="GET" style="text-align:center; padding-top: 25px;">
        <button type="submit" name="only_poor_re" style="font-size: 1.2em; padding: 20px 55px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black;">Users with only 'poor' reviews</button>
    </form>
    <div id="only_poor">
        <!-- retrieve info -->
        <?php
        if (isset($_GET['only_poor_re'])) {
            $sql = "SELECT DISTINCT r.username FROM reviews r 
    LEFT JOIN (
        SELECT DISTINCT username FROM reviews WHERE rating != 'poor'
    ) pr ON r.username = pr.username
    WHERE pr.username IS NULL";

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
                echo "No users found with ONLY poor reviews";
            }
        }



        ?>

    </div>
</body>

</html>