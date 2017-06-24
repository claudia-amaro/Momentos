<?php

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
} else {
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
} else {
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

    $password = $_POST['password'];

    if (!preg_match("#[0-9]+#", $password)) {
        $erro[] = 11;
    }
    if (!preg_match("#[A-Z]+#", $password)) {
        $erro[] = 12;
    }
    if (!preg_match("#[a-z]+#", $password)) {
        $erro[] = 13;
    }
} else {
    //Erro de campo vazio.
    $erro[] = 9;
}

//Verifica se o campo confirmar password está preenchido.
if (!empty($_POST['cpassword'])) {
    //se estiver preenchido, verifica se é igual ao campo password
    if ($_POST["password"] != $_POST["cpassword"]) {
        $erro[] = 15; // erro = 3 -> password e confirmação da password não são iguais
    }
} else {
    // Erro de campo vazio.
    $erro[] = 14;
}