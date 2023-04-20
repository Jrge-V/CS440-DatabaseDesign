<!-- List of users who are favorited by 2 other users -->

<!-- use joe and gary for common favorite of amanda.
use neil and amanda for no common favorite. -->

<!--form -->
<div style=" display: flex;
    flex-direction: column;
    align-items: center;
    border: 5px solid black;
    margin: 0 auto;
    max-width: 600px;
    padding: 20px; ">
    <h2 style="text-decoration: underline;">Favorited Users</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        $sql = "SELECT username FROM user";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            echo '<label for="user" style="font-size: 1.2em;">User 1:</label>';
            echo '<select id="user" name="user" style="font-size: 1.2em;">';
            while ($row = $result->fetch_assoc()) {
                $username = $row["username"];
                echo '<option value="' . $username . '">' . $username . '</option>';
            }
            echo '</select>';
            $result->data_seek(0);
            echo '<label for="user2" style="font-size: 1.2em;">User 2:</label>';
            echo '<select id="user2" name="user2" style="font-size: 1.2em;">';
            while ($row = $result->fetch_assoc()) {
                $username = $row["username"];
                echo '<option value="' . $username . '">' . $username . '</option>';
            }
            echo '</select>';
            echo '<br><br><button type="submit" name="search" style="font-size: 1.2em;">Search for a common favorite</button>';
        } else {
            echo "No users found in database.";
        }
        ?>
    </form>

    <?php
if (isset($_POST["search"])) {
    $user1 = $_POST["user"];
    $user2 = $_POST["user2"];
    $sql = "SELECT favorited_username FROM favorited WHERE username = '$user1' AND favorited_username IN (SELECT favorited_username FROM favorited WHERE username = '$user2')";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2 style='text-align: center; text-decoration: underline;'>Common Favorite Users between " . $user1 . " and " . $user2 . "</h2>";
        echo "<div style='margin: 0 auto; max-width: 800px;'>";
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #ddd;'><th style='padding: 10px; border: 1px solid #000;'>Favorited User</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $favorited_username = $row["favorited_username"];
            echo "<tr><td style='padding: 10px; border: 1px solid #000;'>" . $favorited_username . "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>$user1 and $user2 have no common favorite user.</p>";
    }
}
?>





</div>