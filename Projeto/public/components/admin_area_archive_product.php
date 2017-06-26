<?php
// Ligação à BD 
require_once('../connections/connection.php');

$id_produto = $_GET["id"];

$query = "SELECT estado FROM produto WHERE id_produto=?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $id_produto);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $estado);
$row_result = mysqli_stmt_fetch($stmt);

if ($estado == 1){
    $estado = 2;
} else {
    $estado = 1;
}

mysqli_stmt_close($stmt);

$query = "UPDATE produto SET estado=? WHERE id_produto=?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'ii', $estado, $id_produto);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header('Location: ../pages/admin_area.php#store');