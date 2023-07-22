<?php
use FTP\Connection;
session_start();
include ('database/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = OpenConnection();
    if(isset($_POST['add'])){
        $name = $_POST['name'];
        $powers = $_POST['powers'];
        

        $id = $con->query("SELECT id FROM superhero ORDER BY id DESC LIMIT 1")->fetch_row()[0] + 1;
        $stmt = $con->prepare("INSERT INTO superhero (id, name, powers) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id, $name, $powers);
        $stmt->execute();
    }
    CloseConnection($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add superhero</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>

</head>

<body>
    <button class ="home" type ="button" onclick ="location.href = './index.html'">Home</button>
    <br>

    <section class="add_superhero">
        <form action="add.php" method="post">
            <input id="name" type="text" name="name" placeholder="Name" required>
            <input id="powers" type = "text" name="powers" placeholder="Powers" required>
            <input id="add" type="submit" name="add" value="Add superhero">
        </form>
    </section>

    <section class = "display_add">
        <br>
        <table class="display-table">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Powers</th>
            </thead>

            <tbody>

                <?php
                $con = OpenConnection();
                $result_set = mysqli_query($con, "SELECT * FROM superhero");
                while($row = mysqli_fetch_array($result_set))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['powers'] ?></td>
                    </tr>
                    <?php
                }
                CloseConnection($con);
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>