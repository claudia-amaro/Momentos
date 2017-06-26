<?php
session_start();

//Ligação à BD
require_once('../connections/connection.php');

//obtenção dos dados do token armazenados na BD
if (!empty($_POST["recover_form_submit"])) {
    if ((!empty($_POST["password"])) && (!empty($_POST["cpassword"]))) {
        $token = $_GET['t'];

        $query = "SELECT token, token_validade FROM users WHERE token=?";

        $result = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($result, 's', $token);
        mysqli_stmt_execute($result);
        mysqli_stmt_bind_result($result, $token, $token_validade);

        if (mysqli_stmt_fetch($result)) {
            mysqli_stmt_close($result);

            //Variáveis
            $token_BD = $token;
            $token_validade_BD = $token_validade;
        }
    }
}

//verificação da validade do token
$today = date("Y/m/d H:i:s");

if (strtotime($today) > strtotime($token_validade_BD)) {
    //O token expirou
    //encaminhar para a página onde pede o reenvio
    header("Location: ../pages/password_recover.php");

} else {
    //O token está válido
    //Lista de erros
    $GLOBALS['erro'] = [];

    //inserir o código para inserção na BD da nova password

    //validação dos campos do formulário
    require_once "../components/password_recover_form_validate.php";

    //Verifica se existem erros. Se não existirem, é feito registo.
    if (count($erro) == 0) {
        //Registo da nova password na BD

        $query = "UPDATE users SET password=? WHERE token=?";



        $stmt = mysqli_prepare($link, $query);
        //or die(mysqli_error($link));

        mysqli_stmt_bind_param($stmt, 'ss', $password, $token);

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

            header('Location: ../pages/login_register.php?registo=invalido');
        }
    } else {

        $erro_query_string = http_build_query($erro);
        printf("não executou query");

        header('Location: ../pages/new_password_recover.php?'.$erro_query_string);
    }
    printf("não entrou na query");

}