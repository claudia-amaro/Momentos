<?php

//Ligação à BD
include_once '../connections/connection.php';

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];


$query = "INSERT INTO momentos (latitude, longitude) VALUES (?,?)";

$stmt = mysqli_prepare($link, $query);

mysqli_stmt_bind_param($stmt, 'ss', $latitude, $longitude);

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    //	Registo válido.

    header('Location: ../pages/moments.php');
}
else {
    mysqli_stmt_close($stmt);
    // Registo inválido.

    header('Location: ../pages/login_register.php?registo=invalido');
}