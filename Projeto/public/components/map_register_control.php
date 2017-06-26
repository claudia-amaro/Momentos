<?php

//Ligação à BD
include_once '../connections/connection.php';

//Código correto - Alterar dados
//
//$nome_momento = $_POST['nome_momento'];
//$data_momento = $_POST['data_momento'];
//$historia = $_POST['historia'];
//$latitude = $_POST['latitude'];
//$longitude = $_POST['longitude'];
//
//$id_momento = 34;
//
//
//$query = "UPDATE momentos SET nome_momento=?, data_momento=?, historia=?, latitude=?, longitude=? WHERE id_momento=?";
//
//$stmt = mysqli_prepare($link, $query);
//
//mysqli_stmt_bind_param($stmt, 'ssssss', $nome_momento, $data_momento, $historia, $latitude, $longitude, $id_momento);
//
//if (mysqli_stmt_execute($stmt)) {
//    mysqli_stmt_close($stmt);
//    //	Registo válido.
//
//    header('Location: ../pages/moments.php?');
//} else {
//    mysqli_stmt_close($stmt);
//    // Registo inválido.
//}

//Código incorreto - Inserir dados

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

}