<?php

use FTP\Connection;

include ('database/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = OpenConnection();
    if(isset($_POST['add'])){
        $id = $_POST['id'];
        $model = $_POST['model'];
        $horsepower = $_POST['horsepower'];
        $fuel_consumption = $_POST['fuel_consumption'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $age = $_POST['age'];
        $mileage = $_POST['mileage'];
        $query = "INSERT INTO cars VALUES ($id, '$model', $horsepower, $fuel_consumption, $price, '$color', $age, $mileage)";
        $con -> query($query);
    }

    else if(isset($_POST['update'])){
        $id = $_POST['id'];
        $model = $_POST['model'];
        $horsepower = $_POST['horsepower'];
        $fuel_consumption = $_POST['fuel_consumption'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $age = $_POST['age'];
        $mileage = $_POST['mileage'];
        $query = "UPDATE cars SET model = '$model', horsepower = $horsepower, fuel_consumption = $fuel_consumption, price = $price, color = '$color', age = $age, mileage = $mileage WHERE id = $id";
        $con -> query($query);
    }
    CloseConnection($con);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Car Processing</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type = "text/javascript" src ="script.js"></script>
    </head>

    <body>
        <button class="home" type="button" onclick="location.href='./index.html'">Home</button>
        <br>

    <section class="add_form">
        <form action="crud_cars.php" method="post">
            <input id="id" type="text" name="id" placeholder="id">
            <input id="model" type="text" name="model" placeholder="model">
            <input id="horsepower" type="text" name="horsepower" placeholder="horsepower">
            <input id="fuel_consumption" type="text" name="fuel_consumption" placeholder="fuel_consumption">
            <input id="price" type="text" name="price" placeholder="price">
            <input id="color" type="text" name="color" placeholder="color">
            <input id="age" type="text" name="age" placeholder="age">
            <input id="mileage" type="text" name="mileage" placeholder="mileage">
            <button id="add" type="submit" name="add">Add new car</button>
</form>
</section>

<section class="update_form">
    <form action="crud_cars.php" method="post">
        <input id="id" type="text" name="id" placeholder="id">
        <input id="model" type="text" name="model" placeholder="model">
        <input id="horsepower" type="text" name="horsepower" placeholder="horsepower">
        <input id="fuel_consumption" type="text" name="fuel_consumption" placeholder="fuel_consumption">
        <input id="price" type="text" name="price" placeholder="price">
        <input id="color" type="text" name="color" placeholder="color">
        <input id="age" type="text" name="age" placeholder="age">
        <input id="mileage" type="text" name="mileage" placeholder="mileage">
        <button id="update" type="submit" name="update">Update car</button>
</form>
</section>

<section class="display">
    <br>
    <table class="display-table">
        <thead>
            <th>ID</th>
            <th>Model</th>
            <th>Horsepower</th>
            <th>Fuel Consumption</th>
            <th>Price</th>
            <th>Color</th>
            <th>Age</th>
            <th>Mileage</th>
        </thead>

        <tbody>

            <?php

            $con = OpenConnection();
            $result_set = mysqli_query($con, "SELECT * FROM car");

            while($row = mysqli_fetch_array($result_set)){
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['horsepower'] . "</td>";
                echo "<td>" . $row['fuel_consumption'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['color'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['mileage'] . "</td>";
                echo "<td>
                <button class='btnUpdate' type='button'>Update</button>
                <button class='btnDelete' type='button'>Delete</button>
                </td>
                </tr>";
            }
            CloseConnection($con);
            ?>
        </tbody>
    </table>
</section>

</body>
</html>