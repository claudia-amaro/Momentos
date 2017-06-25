<?php
//Ligação à BD
require_once('../connections/connection.php');

//Início de sessão
session_start();

//VALIDAÇÃO DO LOGIN
$email = $_POST['email'];

$query = "SELECT id_user, nome, apelido, genero, email, password, ref_id_role FROM users WHERE email=?";

$result = mysqli_prepare($link, $query);

mysqli_stmt_bind_param($result, 's', $email);
mysqli_stmt_execute($result);
mysqli_stmt_bind_result($result, $user_id, $nome, $apelido, $genero, $email,  $pass_hash, $role);

if (mysqli_stmt_fetch($result)) {
    if (password_verify($_POST['password'], $pass_hash)) {
        //	Guardar	dados	do	utilizador	em	sessão	e	acção	de	sucesso
//        if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = $email;
        $_SESSION['nome'] = $nome;
        $_SESSION['apelido'] = $apelido;
        $_SESSION['genero'] = $genero;
        $_SESSION['role'] = $role;
        $_SESSION['user_id'] = $user_id;
        header("Location: ../pages/moments.php");

        //criação da cookie para o "lembrar-me"
        if (isset($_SESSION['user'])) {
            if (!empty($_POST['remember'])) {
                setcookie($cookie_name, $email,((time() + 3600 * 24 * 7)));     //duração da cookie: 7 dias
            }
        }
        header("Location: ../pages/moments.php");
    } else {
        // Acção de erro nos dados de login
        header("Location: ../pages/login_register.php?erro=1");
    }
} else {
    // Acção de	erro nos dados de login
    header("Location: ../pages/login_register.php?erro=1");
}

mysqli_stmt_close($result);