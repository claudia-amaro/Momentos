<?php

$emModoCriacao = true;

//verificar se estamos em modo de criação
if (strpos($_SERVER['REQUEST_URI'], "profile_data_control") !== false) {
//    echo "Estamos na edicao";
    $emModoCriacao = false;
}


//VALIDAÇÃO DO FORMULÁRIO
//Lista de erros
$GLOBALS['erro'] = [];

//Verifica se o campo nome está preenchido.
validar_nome();

//Verifica se o campo apelido está preenchido.
validar_apelido();

//Verifica se o campo gene está preenchido.
if ($emModoCriacao) {
    validar_genero();
}

//Verifica se o campo email está preenchido.
validar_email();

//Verifica se o campo passwords está preenchido.
validar_password($emModoCriacao);

if (!$emModoCriacao) {
    //ALTERAÇÃO DA PASSWORD
    //Verifica se o campo passwords está preenchido.
    validar_password($emModoCriacao);

    //Verifica se o campo nif está preenchido.
    validar_nif();

    //Verifica se o campo código postal está preenchido.
    validar_cod_postal();
}


//FUNÇÕES

function validar_nome()
{
    //Verifica se o campo nome está preenchido.
    if (!empty($_POST['nome'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['nome'])) > 50) {
            //Erro de excesso de caracteres.
            $GLOBALS['erro'][] = 2;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 1;
    }
}

function validar_apelido()
{
    //Verifica se o campo apelido está preenchido.
    if (!empty($_POST['apelido'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['apelido'])) > 50) {
            //Erro de excesso de caracteres.
            $GLOBALS['erro'][] = 4;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 3;
    }
}

function validar_genero()
{
    //Verifica se o campo genero está preenchido.
    if (empty($_POST['genero'])) {
        $GLOBALS['erro'][] = 5;
    }
}

function validar_email()
{
    //Verifica se o campo email está preenchido.
    if (!empty($_POST['email'])) {
        //Se estiver preenchido, verifica o número de caracteres.
        if ((strlen($_POST['email'])) > 200) {
            //Erro de excesso de caracteres.
            $GLOBALS['erro'][] = 8;
        }
    } else {
        //Erro de campo vazio.
        $GLOBALS['erro'][] = 7;
    }
}

function validar_nif()
{
    if (!empty($_POST['nif'])) {
        //Se estiver preenchido, verifica se são apenas números
        if (!is_numeric(($_POST['nif']))) {
            //Erro não é número
            $GLOBALS['erro'][] = 17;
        } elseif ((strlen($_POST['nif'])) != 9) {
            //Verifica o número de caracteres.
            ////Erro de falta ou excesso de caracteres.
            $GLOBALS['erro'][] = 22;
        }
    }
}

function validar_cod_postal()
{
    if (!empty($_POST['codigo_postal'])) {
        if (!preg_match('/[0-9]{4}-[0-9]{3}/', $_POST['codigo_postal'])) {
            //Erro de código postal com formato não permitido (xxxx-xxx)
            $GLOBALS['erro'][] = 19;
        }
    }
}

function validar_password($emModoCriacao)
{
    $pass = "";
    $confPass = "";

    if ($emModoCriacao) {
        //em modo criação

        //Verifica se o campo passwords está preenchido.
        if (!empty($_POST['password'])) {
            validar_req_min_password(($_POST['password']));
            if (!empty($_POST['cpassword'])) {
                validar_password_iguais($_POST['password'], $_POST['cpassword']);
            } else {
                //Erro de campo vazio.
                $GLOBALS['erro'][] = 14;
            }
        } else {
            //Erro de campo vazio.
            $GLOBALS['erro'][] = 9;
        }
    } else {
        //em modo de edição

        //Verifica se o campo passwords está preenchido.
        if (!empty($_POST['new_password'])) {
            validar_req_min_password(($_POST['new_password']));
            if (!empty($_POST['c_password'])) {
                validar_password_iguais($_POST['new_password'], $_POST['c_password']);
            } else {
                //nunca entra aqui porque se estiver vazio, não bate com a password, logo dá esse erro
                //Erro de campo vazio.
                $GLOBALS['erro'][] = 14;
            }

            if (!empty($_POST['atual_password'])) {
                $id_user = $_SESSION['user_id'];
                $atual_password = $_POST['atual_password'];

                //Ligação à BD
                require('../connections/connection.php');

                //validar se a atual password é igual à que consta na BD
                $query = "SELECT password FROM users WHERE id_user=?";
                $result = mysqli_prepare($link, $query);

                mysqli_stmt_bind_param($result, 'i', $id_user);
                mysqli_stmt_execute($result);
                mysqli_stmt_bind_result($result, $pass_hash);

                if (mysqli_stmt_fetch($result)) {
                    if (!password_verify($atual_password, $pass_hash)) {
                        $GLOBALS['erro'][] = 20; // erro = 20 -> atual password e não é igual à da BD
                    }
                } else {
                    //Erro. Falhou o fetch, não encontrou a password
                    $GLOBALS['erro'][] = 21; // erro = 21 -> falha na verificação da atual password
                }
                mysqli_stmt_close($result);
            } else {
                //Erro de campo vazio.
                $GLOBALS['erro'][] = 18;
            }
        }
    }
}

function validar_req_min_password($pass)
{
    //Se estiver preenchido, verifica o número de caracteres.
    if ((strlen($pass)) < 8 || (strlen($pass)) > 12) {
        //Erro de falta ou excesso de caracteres.
        $GLOBALS['erro'][] = 10;
    }

    if (!preg_match("#[0-9]+#", $pass)) {
        $GLOBALS['erro'][] = 11;
    }
    if (!preg_match("#[A-Z]+#", $pass)) {
        $GLOBALS['erro'][] = 12;
    }
    if (!preg_match("#[a-z]+#", $pass)) {
        $GLOBALS['erro'][] = 13;
    }
}

function validar_password_iguais($pass, $cpass)
{
    if ($pass != $cpass) {
        $GLOBALS['erro'][] = 15; // erro = 3 -> password e confirmação da password não são iguais
    }
}