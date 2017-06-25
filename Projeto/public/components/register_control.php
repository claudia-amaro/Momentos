<?php

session_start();

//Ligação à BD
require_once('../connections/connection.php');

//Lista de erros
$GLOBALS['erro'] = [];

//VALIDAÇÃO DO FORMULÁRIO
require_once '../components/form_validate.php';

//Verifica se existem erros. Se não existirem, é feito registo.
if(count($GLOBALS['erro'])==0) {
    //Registo do utilizador na BD

    $query = "INSERT INTO users (nome, apelido, genero, email, password) VALUES (?,?,?,?,?)";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'sssss', $nome, $apelido, $genero, $email, $password);

    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        //	Registo válido.

        session_unset();

        $_SESSION['user'] = $email;
        $_SESSION['nome'] = $nome;
        $_SESSION['apelido'] = $apelido;
        $_SESSION['genero'] = $genero;

        //Obter dados gerados na BD
        $query = "SELECT id_user, ref_id_role FROM users WHERE email=?";

        $result = mysqli_prepare($link, $query);

        mysqli_stmt_bind_param($result, 's', $email);
        mysqli_stmt_execute($result);
        mysqli_stmt_bind_result($result, $user_id, $role);

        if (mysqli_stmt_fetch($result)) {
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;
        }

        mysqli_stmt_close($result);

        header('Location: ../pages/moments.php');
    }
    else {
        mysqli_stmt_close($stmt);
        // Registo inválido.

        $_SESSION['nome'] = $_POST['nome'];
        $_SESSION['apelido'] = $_POST['apelido'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['registo']='invalido';

        header('Location: ../pages/login_register.php?registo=invalido');
    }
}
else{
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['apelido'] = $_POST['apelido'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['genero'] = $_POST['genero'];
    $_SESSION['registo']='invalido';

    if(!in_array("9", $GLOBALS['erro']) && !in_array("10", $GLOBALS['erro']) && !in_array("11", $GLOBALS['erro']) && !in_array("12", $GLOBALS['erro']) && !in_array("13", $GLOBALS['erro']) && !in_array("14", $GLOBALS['erro']) && !in_array("15", $GLOBALS['erro'])){
        $GLOBALS['erro'][] = 16;
    }

    $erro_query_string = http_build_query($GLOBALS['erro']);

    header('Location: ../pages/login_register.php?'.$erro_query_string);
}