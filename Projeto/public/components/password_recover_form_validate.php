<?php

//VALIDAÇÃO DO FORMULÁRIO
//Lista de erros
$GLOBALS['erro'] = [];

//Verifica se o campo password está preenchido.
validar_password();


//FUNÇÕES

function validar_password()
{
    $pass = "";
    $confPass = "";

        //Verifica se o campo passwords está preenchido.
        if (!empty($_POST['password'])) {
            validar_req_min_password(($_POST['password']));
            if (!empty($_POST['cpassword'])) {
                validar_password_iguais($_POST['password'], $_POST['cpassword']);
            } else {
                //Erro de campo vazio.
                $GLOBALS['erro'][] = 4;
            }
        } else {
            //Erro de campo vazio.
            $GLOBALS['erro'][] = 3;
        }
}

function validar_req_min_password($pass)
{
    //Se estiver preenchido, verifica o número de caracteres.
    if ((strlen($pass)) < 8 || (strlen($pass)) > 12) {
        //Erro de falta ou excesso de caracteres.
//        $GLOBALS['erro'][] = 10;
        $GLOBALS['erro'][] = 5;
    }

    if (!preg_match("#[0-9]+#", $pass)) {
//        $GLOBALS['erro'][] = 11;
        $GLOBALS['erro'][] = 6;
    }
    if (!preg_match("#[A-Z]+#", $pass)) {
//        $GLOBALS['erro'][] = 12;
        $GLOBALS['erro'][] = 7;
    }
    if (!preg_match("#[a-z]+#", $pass)) {
//        $GLOBALS['erro'][] = 13;
        $GLOBALS['erro'][] = 8;
    }
}

function validar_password_iguais($pass, $cpass)
{
    if ($pass != $cpass) {
//        $GLOBALS['erro'][] = 15; // erro = 3 -> password e confirmação da password não são iguais
        $GLOBALS['erro'][] = 9; // erro = 3 -> password e confirmação da password não são iguais
    }
}