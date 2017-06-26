<?php
// Ligação à BD 
require_once('../connections/connection.php');

$id_user = (int) $_GET["a"];
$role = $_GET["b"]; // Falta validar

$new_role = 0;
if ($role == 1){
    //era admin vai ser normal
    $new_role = 2;
}
else{
    //era normal, vai ser admin
    $new_role = 1;
}

$query = "UPDATE users SET ref_id_role=? WHERE id_user=?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, 'ii', $new_role, $id_user);

if(mysqli_stmt_execute($stmt)) {
    $_SESSION["role"] = $new_role;
    header('Location: ../pages/admin_area.php');
}
else{
    //tratar erros possiveis
    header('Location: ../pages/admin_area.php?msg=1&a='.$id_user);
}

mysqli_stmt_close($stmt);

