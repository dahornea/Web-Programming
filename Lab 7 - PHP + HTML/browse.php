<?php
use FTP\Connection;

include ('database/connection.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <title>Browse cars</title>
        <script type="text/javascript" src="browse.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
<body>
    <button class = "home" type = "button" onclick = "location.href ='./index.html'">Home</button>

    <div id="previous-filter">

    </div>

    <center>
        <div id = "main">
            <h1>Cars</h1>
            <div" style="float: left";>

            <select id ="select-type" name="Select filter" onchange = "get_filtered_by_horsepower()">
                <?php
                    $con = OpenConnection();
                    $sql = "SELECT DISTINCT horsepower FROM car";
                    $result = $con -> query($sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                             $horsepower = ''. $row['horsepower'] . '';
                             echo '<option>' . $horsepower . '</option>';
                        }
                    }

                    CloseConnection($con);
                ?>

            </select>

                </div>

    <table id = "browse-table" class ="browse-table">
        <thead id>
            <th>ID</th>
            <th>Model</th>
            <th>Horsepower</th>
            <th>Fuel consumption</th>
            <th>Price</th>
            <th>Color</th>
            <th>Age</th>
            <th>Mileage</th>
                </thead>
        <tbody id = "browse-tbody">
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
                    echo "</tr>";
                }
                CloseConnection($con);
            ?>
        </tbody>
    </table>
    <label>
            </label>
        </div>
    </center>
</body>
</html>