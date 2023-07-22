<?php
use FTP\Connection;
include('database/connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = OpenConnection();
    $id = $con->real_escape_string($_POST['id']);
    $stmt = $con->prepare("DELETE FROM car WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    CloseConnection($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete car</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
    <button class="home" type="button" onclick="location.href ='./index.html'">Home</button>
    <br>

    <section class="delete_car">
        <form action="delete.php" method="post">
            <br>
            <table class="display-table">
                <thead>
                    <th>ID</th>
                    <th>Model</th>
                    <th>Horsepower</th>
                    <th>Fuel consumption</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Age</th>
                    <th>Mileage</th>
                </thead>

                <tbody>

                    <?php
                    $con = OpenConnection();

                    $result_set = mysqli_query($con, "SELECT * FROM car");

                    while ($row = mysqli_fetch_array($result_set)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['horsepower'] . "</td>";
                        echo "<td>" . $row['fuel_consumption'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['mileage'] . "</td>";
                        echo "<td> <button class='DeleteBtn' type='button' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button> </td> </tr>";
                    }

                    CloseConnection($con);
                    ?>

                </tbody>
            </table>
        </form>
    </section>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this car?")) {
                // User confirmed deletion, submit the form
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "delete.php");

                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", "id");
                hiddenField.setAttribute("value", id);

                form.appendChild(hiddenField);
                document.body.appendChild(form);
                form.submit();
            } else {
                // User canceled deletion
                return false;
            }
        }
    </script>
</body>

</html>