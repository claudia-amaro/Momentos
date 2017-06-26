<?php
session_start();

//Ligação à BD
require_once('../connections/connection.php');

//Lista de erros
$GLOBALS['erro'] = [];

//VALIDAÇÃO DO FORMULÁRIO
require_once '../components/password_recover_email_form_validate.php';

//Verifica se existem erros. Se não existirem, é feito registo.
if(count($GLOBALS['erro'])==0) {

    if (!empty($_POST["forgot-password"])) {
        if (!empty($_POST["email"])) {

            $email = $_POST["email"];

            $query = "SELECT id_user, nome, apelido, email FROM users WHERE email=?";

            $result = mysqli_prepare($link, $query);

            mysqli_stmt_bind_param($result, 's', $email);
            mysqli_stmt_execute($result);
            mysqli_stmt_bind_result($result, $id_user, $nome, $apelido, $email);

            if (mysqli_stmt_fetch($result)) {
                //Variáveis
                $id_user_BD = $id_user;
                $nome_BD = $nome;
                $apelido_BD = $apelido;
                $email_BD = $email;
                mysqli_stmt_close($result);

                require("../components/password_recover_email.php");
                header("Location: ../pages/password_recover.php?msg=1");
            }
            else {
                //não executou a query - erro
                header("Location: ../pages/password_recover.php?msg=2");
            }
        }
    }
}
else{
    $erro_query_string = http_build_query($GLOBALS['erro']);

    header('Location: ../pages/password_recover.php?'.$erro_query_string);
}
?>