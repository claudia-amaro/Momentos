<?php
session_start();

//Ligação à BD
require_once('../connections/connection.php');

//obtenção dos dados do token armazenados na BD
if (!empty($_POST["recover_form_submit"])) {
    if ((!empty($_POST["password"])) && (!empty($_POST["password_confirmation"]))) {

        $token = $_POST["t"];

        $query = "SELECT token, token_validade FROM users WHERE token=?";

        $result = mysqli_prepare($link, $query);

        mysqli_stmt_bind_param($result, 's', $token);
        mysqli_stmt_execute($result);
        mysqli_stmt_bind_result($result, $token, $token_validade);

        if (mysqli_stmt_fetch($result)) {
            //Variáveis
            $token_BD = $token;
            $token_validade_BD = $token_validade;
//            var_dump($token_BD, $token_validade_BD);
//            require_once("password_recover_email.php");
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

//verificação da validade do token
$today = date("Y-m-d H:i:s");
if (strtotime($today) > strtotime($token_expireDate)) {
    echo "O token expirou";
    //encaminhar para a página onde pede o reenvio
//    header("Location: ../pages/password_recover.php");

} else {
    echo "O token está válido";
    //inserir o código para inserção na BD da nova password

    //validação dos campos do formulário
    require_once "form_validate.php";

    //Verifica se existem erros. Se não existirem, é feito registo.
    if (count($erro) == 0) {
        //Registo da nova password na BD

        $query = "INSERT INTO users (password) VALUES (?)";

        $stmt = mysqli_prepare($link, $query);

        mysqli_stmt_bind_param($stmt, 's', $password);

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            //	Recuperação válida

            session_unset();

            header('Location: ../pages/login_register.php');
        } else {
            mysqli_stmt_close($stmt);
            // Registo inválido.
            $_SESSION['password_recover'] = 'invalido';

//            header('Location: ../pages/login_register.php?registo=invalido');
        }
    } else {
       if (!in_array("9", $erro) && !in_array("10", $erro) && !in_array("11", $erro) && !in_array("12", $erro) && !in_array("13", $erro)) {
            $erro[] = 16;
        }

        $erro_query_string = http_build_query($erro);

//        header('Location: ../pages/login_register.php?' . $erro_query_string);
    }
}