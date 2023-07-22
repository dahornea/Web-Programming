<?php

use FTP\Connection;
session_start();
include ('database/connection.php');

$errors = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = OpenConnection();
    if(isset($_POST['update'])){
        $id = $con->real_escape_string($_POST['id']);
        $model = validateStringInput($_POST['model'], 'Model');
        $horsepower = validateNumericInput($_POST['horsepower'], 'Horsepower');
        $fuel_consumption = validateNumericInput($_POST['fuel_consumption'], 'Fuel Consumption');
        $price = validateNumericInput($_POST['price'], 'Price');
        $color = validateStringInput($_POST['color'], 'Color');
        $age = validateNumericInput($_POST['age'], 'Age');
        $mileage = validateNumericInput($_POST['mileage'], 'Mileage');

        if(count($errors) === 0){
            $stmt = $con -> prepare("UPDATE car SET model = ?, horsepower = ?, fuel_consumption = ?, price = ?, color = ?, age = ?, mileage = ? WHERE id = ?");
            $stmt -> bind_param("siiisiii", $model, $horsepower, $fuel_consumption, $price, $color, $age, $mileage, $id);
            $stmt -> execute();
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
    <title>Modify car</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .error{
            color: red;
        }
    </style>
    <script type = "text/javascript" src ="script.js"></script>
</head>

<body>
<button class="home" type="button" onclick="location.href='./index.html'">Home</button>
<br>

<section class="update_form">
    <?php if(count($errors) > 0): ?>
        <div class="error">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="modify.php" method="POST">
        <input id="id" type="text" name="id" placeholder="id" hidden>
        <input id="model" type="text" name="model" placeholder="model">
        <input id="horsepower" type="text" name="horsepower" placeholder="horsepower">
        <input id="fuel_consumption" type="text" name="fuel_consumption" placeholder="fuel_consumption">
        <input id="price" type="text" name="price" placeholder="price">
        <input id="color" type="text" name="color" placeholder="color">
        <input id="age" type="text" name="age" placeholder="age">
        <input id="mileage" type="text" name="mileage" placeholder="mileage">
        <input id="update" type="submit" name="update" value="Update car">
    </form>
</section>

<section class="display_modify">
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
