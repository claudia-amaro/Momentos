<?php
// Ligação à BD 
require_once('../connections/connection.php');

if(isset($_GET['id'])) {
    $id_momento = $_GET["id"];

    $query = "DELETE FROM momentos WHERE id_momento=?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_momento);

    mysqli_stmt_execute($stmt);

    var_dump($stmt);

    mysqli_stmt_close($stmt);
}
//header('Location: ../pages/admin_area.php#moments');