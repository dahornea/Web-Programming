<?php

use FTP\Connection;
session_start();
include ('database/connection.php');

$con = OpenConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    $powers = $_POST['powers'];

    $updateQuery = "UPDATE Superhero SET powers = '$powers' WHERE name = '$username'";
    $con->query($updateQuery);
}
?>

<h2>Modify Your Powers</h2>
<button class="home" type="button" onclick="location.href='./index.html'">Home</button>
<form method="POST" action="">
    <label for="username">Superhero Username:</label>
    <input type="text" name="username" required><br><br>
    <label for="powers">New Powers:</label>
    <input type="text" name="powers" required><br><br>
    <input type="submit" value="Modify Powers">
</form>

<?php
$con->close();
?>
</body>
</html>