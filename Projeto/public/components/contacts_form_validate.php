<?php

//VALIDAÇÃO DO FORMULÁRIO
//Lista de erros
$GLOBALS['erro'] = [];

//Verifica se o campo nome está preenchido.
validar_nome();

//Verifica se o campo email está preenchido.
validar_email();

//Verifica se o campo assunto está preenchido.
validar_assunto();

//Verifica se o campo mensagem está preenchido.
validar_mensagem();


//FUNÇÕES

function validar_nome()
{
    //Verifica se o campo nome está preenchido.
    if (!empty($_POST['nome'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['nome'])) > 50 || (strlen($_POST['nome'])) < 3) {
            //Erro de excesso ou defeito de caracteres.
            $GLOBALS['erro'][] = 2;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 1;
    }
}

function validar_email()
{
    //Verifica se o campo email está preenchido.
    if (!empty($_POST['email'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['email'])) > 100) {
            //Erro de excesso de caracteres.
            $GLOBALS['erro'][] = 4;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 3;
    }
}

function validar_assunto() {
    //Verifica se o campo assunto está preenchido.
    if (!empty($_POST['assunto'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['assunto'])) > 50 || (strlen($_POST['assunto'])) < 3) {
            //Erro de excesso ou defeito de caracteres.
            $GLOBALS['erro'][] = 6;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 5;
    }
}

function validar_mensagem() {
    //Verifica se o campo assunto está preenchido.
    if (!empty($_POST['mensagem'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['mensagem'])) > 500 || (strlen($_POST['mensagem'])) < 3) {
            //Erro de excesso ou defeito de caracteres.
            $GLOBALS['erro'][] = 8;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 7;
    }
}