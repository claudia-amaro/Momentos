<?php

    session_start();

    include_once "../connections/connection.php";

    //Registo do utilizador na BD

    $query = "INSERT INTO momentos (nome_momento, historia, arvore, data_momento, kit, ref_id_user, ref_id_local) VALUES (?,?,?,?,?,?,?)";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'sssssss', $nome_momento, $historia, $arvore, $data_momento, $kit, $ref_id_user, $ref_id_local);

    $nome_momento = $_POST['nome_momento'];
    $historia = $_POST['historia'];
    $arvore = $_POST['nome_arvore'];
    $data_momento = $_POST['data_momento'];
    $kit = $_POST['kit'];
    $ref_id_user = $_SESSION['user_id'];
    $ref_id_local = $_POST['local'];

    if (mysqli_stmt_execute($stmt)) {
        //Registo válido
        mysqli_stmt_close($stmt);


        header('Location: ../pages/moments.php');
    }
    else {
        // Registo inválido.
        mysqli_stmt_close($stmt);

        header('Location: ../pages/moments_register.php');
    }
