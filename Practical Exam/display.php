
    <?php
    // Database configuration
    use FTP\Connection; 
    session_start();
    include ('database/connection.php');
    $con = OpenConnection();;
    if (isset($_GET['power'])) {
        $power = $_GET['power'];

        // Retrieve the superheroes with the specific power



        $selectQuery = "SELECT * FROM Superhero WHERE powers like '%$power%'";
        $result = $con->query($selectQuery);

        if ($result->num_rows > 0) {
            echo "<h2>Superheroes with $power Power:</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>{$row['name']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No superheroes found with $power power.</p>";
        }
    }
    ?>

    <h2>Display Superheroes by Power</h2>
    <button class = "home" type="button" onclick="location.href='./index.html'">Home</button>
    <form method="GET" action="">
        <label for="power">Power:</label>
        <input type="text" name="power" required><br><br>
        <input type="submit" value="Search">
    </form>

    <?php
    $con->close();
    ?>
</body>
</html>
