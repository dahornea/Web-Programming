<?php
use FTP\Connection;
session_start();
include('database/connection.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = OpenConnection();
    if (isset($_POST['add'])) {
        $model = validateStringInput($_POST['model'], 'Model');
        $horsepower = validateNumericInput($_POST['horsepower'], 'Horsepower');
        $fuel_consumption = validateNumericInput($_POST['fuel_consumption'], 'Fuel Consumption');
        $price = validateNumericInput($_POST['price'], 'Price');
        $color = validateStringInput($_POST['color'], 'Color');
        $age = validateNumericInput($_POST['age'], 'Age');
        $mileage = validateNumericInput($_POST['mileage'], 'Mileage');

        if (count($errors) === 0) {
            // Get last id from the car table and increment it by 1, if the table is empty, set the id to 0
            $id = $con->query("SELECT id FROM car ORDER BY id DESC LIMIT 1")->fetch_row()[0] + 1;

            $stmt = $con->prepare("INSERT INTO car (id, model, horsepower, fuel_consumption, price, color, age, mileage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiiisii", $id, $model, $horsepower, $fuel_consumption, $price, $color, $age, $mileage);
            $stmt->execute();
        }
    }

    CloseConnection($con);
}

function validateStringInput($input, $fieldName)
{
    global $errors;

    $input = trim($input);
    if (empty($input)) {
        $errors[] = "Please enter $fieldName.";
    }
    if(!is_string($input)) {
        $errors[] = "$fieldName should be a string.";
    }

    return $input;
}

function validateNumericInput($input, $fieldName)
{
    global $errors;

    $input = trim($input);
    if (empty($input)) {
        $errors[] = "Please enter $fieldName.";
    } else
    if (!is_numeric($input)) {
        $errors[] = "$fieldName should be a number.";
    }
    if($input < 0){
        $errors[] = "$fieldName should be a positive number.";
    }
    return $input;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add car</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error{
            color: red;
        }
    </style>
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
    <button class="home" type="button" onclick="location.href ='./index.html'">Home</button>
    <br>

    <section class="add_car">
        <?php if (count($errors) > 0) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="add.php" method="post">
            <input id="model" type="text" name="model" placeholder="Model">
            <input id="horsepower" type="text" name="horsepower" placeholder="Horsepower">
            <input id="fuel_consumption" type="text" name="fuel_consumption" placeholder="Fuel Consumption">
            <input id="price" type="text" name="price" placeholder="Price">
            <input id="color" type="text" name="color" placeholder="Color">
            <input id="age" type="text" name="age" placeholder="Age">
            <input id="mileage" type="text" name="mileage" placeholder="Mileage">
            <input id="add" type="submit" name="add" value="Add new car">
        </form>
    </section>

    <section class="display_add">
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
                    echo "</tr>";
                }
                CloseConnection($con);
                ?>

            </tbody>
        </table>
    </section>

</body>

</html>
