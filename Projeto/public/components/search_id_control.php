<?php

require_once('../connections/connection.php');

$id_momento_procurado = $_GET['id'];
$id_momento = array();

$query = "SELECT id_momento FROM momentos";
$result = mysqli_query($link, $query);

// Mostrar dados
while ($row_result = mysqli_fetch_assoc($result)){
array_push($id_momento,$row_result["id_momento"]);
};

mysqli_close($link);

if(in_array($id_momento_procurado, $id_momento)){
    header('Location: ../pages/moments_detail.php?'.$id_momento_procurado);
}
else{
    header('Location: ../pages/moments_search.php?id_invalido=true');
}