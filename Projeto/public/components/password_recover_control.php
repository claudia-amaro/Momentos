<?php
session_start();

//Ligação à BD
require_once('../connections/connection.php');

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

//            var_dump($id_user_BD, $nome_BD, $apelido_BD, $email_BD);
            require_once("password_recover_email.php");
//            header("Location: ../pages/password_recover.php?msg=1");
//        } else {
//            header("Location: ../pages/password_recover.php?msg=1");
//        }
        }

//        if (!empty($user)) {
//            require_once("password_recover_email.php");
//            header("Location: ../pages/password_recover.php?msg=1");
//        } else {
//            header("Location: ../pages/password_recover.php?msg=1");
//        }
    }
}
?>