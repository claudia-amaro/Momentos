<?php

//VALIDAÇÃO DO FORMULÁRIO
//Lista de erros
$GLOBALS['erro'] = [];

//Verifica se o campo email está preenchido.
validar_email();


//FUNÇÕES

function validar_email()
{
    //Verifica se o campo email está preenchido.
    if (!empty($_POST['email'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['email'])) > 100) {
            //Erro de excesso de caracteres.
            $GLOBALS['erro'][] = 2;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 1;
    }
}