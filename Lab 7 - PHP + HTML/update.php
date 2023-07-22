<?php

use FTP\Connection;

include ('database/connection.php');
IF($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = OpenConnection();
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $model = $con->real_escape_string($_POST['model']);
        $horsepower = $con->real_escape_string($_POST['horsepower']);
        $fuel_consumption = $con->real_escape_string($_POST['fuel_consumption']);
        $price = $con->real_escape_string($_POST['price']);
        $color = $con->real_escape_string($_POST['color']);
        $age = $con->real_escape_string($_POST['age']);
        $mileage = $con->real_escape_string($_POST['mileage']);
        $sql = "UPDATE cars SET model='$model', horsepower='$horsepower', fuel_consumption='$fuel_consumption', price='$price', color='$color', age='$age', mileage='$mileage' WHERE id='$id'";
    }
    $con->query($sql);
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
</head>

<body>
    <button type="button" onclick="location.href='./index.html'">Home</button>
    <br>

</body>

<section class="update_form">
    <form class="update" action="update.php" method="post">
        <input id="Model" type="text" name="model" placeholder="model">
        <input id="Horsepower" type="text" name="horsepower" placeholder="horsepower">
        <input id="Fuel_consumption" type="text" name="fuel_consumption" placeholder="fuel_consumption">
        <input id="Price" type="text" name="price" placeholder="price">
        <input id="Color" type="text" name="color" placeholder="color">
        <input id="Age" type="text" name="age" placeholder="age">
        <input id="Mileage" type="text" name="mileage" placeholder="mileage">
        <input id="update" type="submit" name="update" value="Update">
    </form>
</section>

</html>
