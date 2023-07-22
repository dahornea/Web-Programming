<?php

function OpenConnection(): mysqli{
    $server = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "cars";

    $con = mysqli_connect($server, $user, $pass, $db);

    if(!$con){
        die("Connection failed: " . mysqli_connect_error());
    }

    return $con;
}

function CloseConnection(mysqli $con){
    $con -> close();
}