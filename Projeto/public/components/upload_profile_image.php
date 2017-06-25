<?php
session_start();

require_once "../connections/connection.php";

$target_dir = "../../../../IIS_tmp/img_perfil/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . $_SESSION['user_id']. ".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Verifica se o ficheiro é ou não uma imagem
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["upload_profile_image"]["tmp_name"]);
    if($check !== false) {
        echo "O ficheiro é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        $erro = 4;
    }
}

//// Verifica se o ficheiro já existe
//if (file_exists($target_file)) {
//    echo "O ficheiro já existe.";
//    $uploadOk = 0;
//}

// Verifica o tamanho do ficheiro
//para ficheiros de 140px por 140px cada terá 58800bytes
if ($_FILES["upload_profile_image"]["size"] > 58800) {
    $uploadOk = 0;
    $erro = 2;
}

// Verifica os tipos de ficheiro permitidos
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    $uploadOk = 0;
    $erro = 3;
}
// Verifica se o $uploadOk está no estado 0 de um erro
if ($uploadOk == 0) {
    switch ($erro) {
        case 1:
            //erro 1 = "Houve um erro ao carregar a imagem.";
            header('Location: ../pages/profile.php?erro=1');
            break;
        case 2:
            //erro 2 = "O ficheiro não foi carregado porque é demasiado grande.";
            header('Location: ../pages/profile.php?erro=2');
            break;
        case 3:
            //erro 3 = "Apenas são permitidos ficheiros dos formatos JPG, JPEG, PNG e GIF."
            header('Location: ../pages/profile.php?erro=3');
            break;
        case 4:
            //erro 4 = "O ficheiro não é uma imagem.";
            header('Location: ../pages/profile.php?erro=4');
            break;
    }

// Se estiver ok, tenta fazer o upload do ficheiro
} else {
    if (move_uploaded_file($_FILES["upload_profile_image"]["tmp_name"], $target_file)) {
        //echo "O ficheiro ". basename( $_FILES["upload_profile_image"]["name"]). " foi carregado com sucesso.";

        header('Location: ../pages/profile.php');

    } else {
        header('Location: ../pages/profile.php?erro=1');
    }
}
?>