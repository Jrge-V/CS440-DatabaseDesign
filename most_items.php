<!-- List the users who posted the most number of items since 5/1/2020 (inclusive); if there is a tie,
list all the users who have a tie -->

<!DOCTYPE html>
<html>

<head>
    <title>List Users with Most Items</title>
</head>

<body>
    <form method="GET" style="text-align:center; padding-top: 25px;">
        <button type="submit" name="list_users" style="font-size: 1.2em; padding: 20px 55px; cursor: pointer; margin-left: auto; margin-right: auto; border: 5px solid black;">Users with most Items Since 5/1/2020</button>
    </form>
    <div id="user-list">
        <!--Retreive info-->
        <?php

        // check if button has been clicked
        if (isset($_GET['list_users'])) {

            // query the database to get the number of items posted by each user since 5/1/2020
            $sql = "SELECT username, COUNT(*) AS num_items
            FROM items
            WHERE post_date >= '2020-05-01'
            GROUP BY username
            ORDER BY num_items DESC";

            $result = $link->query($sql);

            // check if there are any results
            if ($result->num_rows > 0) {
                $max_items = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($row["num_items"] > $max_items) {
                        $max_items = $row["num_items"];
                        $user_list = array();
                        $user_list[] = $row["username"];
                    } elseif ($row["num_items"] == $max_items) {
                        $user_list[] = $row["username"];
                    } else {
                        // this user has posted fewer items than the current maximum, ignore them
                    }
                }
            
                // display the list of users with the most items
                echo "<div style='margin: 0 auto; max-width: 800px;'>";
                echo "<table style='border-collapse: collapse; width: 100%;'>";
                echo "<tr style='background-color: #ddd;'><th style='padding: 10px; border: 1px solid #000;'>Username</th><th style='padding: 10px; border: 1px solid #000;'>Number of Items</th></tr>";
                foreach ($user_list as $user) {
                    echo "<tr><td style='padding: 10px; border: 1px solid #000;'>$user</td><td style='padding: 10px; border: 1px solid #000;'>$max_items</td></tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "No users have posted any items since 5/1/2020.";
            }
            
        }
        ?>
    </div>
</body>

</html>