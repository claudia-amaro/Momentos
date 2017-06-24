<?php
// Ligação à BD 
require_once('../connections/connection.php');

$id_user = (int) $_GET["id"];
$role = $_GET["role"]; // Falta validar

$query = "UPDATE users SET ref_id_role=? WHERE id_user=?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'ii', $role, $id_user);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

//header('Location: ../pages/admin_area.php');