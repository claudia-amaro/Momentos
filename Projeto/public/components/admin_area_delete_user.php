<?php
// Ligação à BD 
require_once('../connections/connection.php');

$id_user = (int) $_GET["id"];

$query = "DELETE FROM users WHERE id_user=?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'i', $id_user);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header('Location: ../pages/admin_area.php');