<!-- List of users who are favorited by 2 other users -->

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
        } else {
            echo "No users found in database.";
        }
        ?>
    </form>
</div>