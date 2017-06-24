<?php

session_start();

//Ligação à BD
require_once('../connections/connection.php');

//VALIDAÇÃO DO FORMULÁRIO

//Lista de erros
$erro = [];

//Verifica se o campo nome está preenchido.
if (!empty($_POST['nome'])) {
    //Se estiver preenchido, verifica o número de caracteres.
    if ((strlen($_POST['nome'])) > 50) {
        //Erro de excesso de caracteres.
        $erro[] = 2;
    }
}else {
    //Erro de campo vazio.
    $erro[] = 1;
}


//Verifica se o campo apelido está preenchido.
if (!empty($_POST['apelido'])) {
    //Se estiver preenchido, verifica o número de caracteres.
    if ((strlen($_POST['apelido'])) > 50) {
        //Erro de excesso de caracteres.
        $erro[] = 4;
    }
}else {
    //Erro de campo vazio.
    $erro[] = 3;
}

//Verifica se o campo gene está preenchido.
if (empty($_POST['genero'])) {
           $erro[] = 5;
    }


//Verifica se o campo email está preenchido.
if (!empty($_POST['email'])) {
    //Se estiver preenchido, verifica o número de caracteres.
    if ((strlen($_POST['email'])) > 200) {
        //Erro de excesso de caracteres.
        $erro[] = 8;
    }
} else {
    //Erro de campo vazio.
    $erro[] = 7;
}

//Verifica se o campo passwords está preenchido.
if (!empty($_POST['password'])) {
    //Se estiver preenchido, verifica o número de caracteres.
    if ((strlen($_POST['password'])) < 8 || (strlen($_POST['password'])) > 12) {
        //Erro de falta ou excesso de caracteres.
        $erro[] = 10;
    }

    $password = $_POST['password'] ;

    if (!preg_match("#[0-9]+#", $password)) {
        $erro[] = 11;
    }
    if (!preg_match("#[A-Z]+#", $password)) {
        $erro[] = 12;
    }
    if (!preg_match("#[a-z]+#", $password)) {
        $erro[] = 13;
    }
}else {
    //Erro de campo vazio.
    $erro[] = 9;
}

//Verifica se o campo confirmar password está preenchido.
if (!empty($_POST['cpassword'])) {
    //se estiver preenchido, verifica se é igual ao campo password
    if ($_POST["password"] != $_POST["cpassword"]) {
        $erro[] = 15; // erro = 3 -> password e confirmação da password não são iguais
    }
}
else {
    // Erro de campo vazio.
    $erro[] = 14;
}

//Verifica se existem erros. Se não existirem, é feito registo.
if(count($erro)==0) {
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
        $_SESSION['role'] = $role;

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

    if(!in_array("9", $erro) && !in_array("10", $erro) && !in_array("11", $erro) && !in_array("10", $erro) && !in_array("11", $erro) && !in_array("12", $erro) && !in_array("13", $erro) && !in_array("14", $erro) && !in_array("15", $erro)){
        $erro[] = 16;
    }

    $erro_query_string = http_build_query($erro);

    header('Location: ../pages/login_register.php?'.$erro_query_string);
}
