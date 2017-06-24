<?php
session_start();

//Ligação à BD
require_once('../connections/connection.php');

$user_id = $_SESSION['user_id'];
//$user = $_SESSION['user'];


$query = "UPDATE users SET nome=?,apelido=?,email=?,data_nascimento=?,rua=?,numero_porta=?,andar=?,
    codigo_postal=?,cidade=? WHERE id_user=$user_id";

echo "entrei no if === ''";

$stmt = mysqli_prepare($link, $query);

//definição das variáveis
$nome = $_POST['nome'];
$apelido = $_POST['apelido'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$nif = $_POST['nif'];
$rua = $_POST['rua'];
$numero_porta = $_POST['numero_porta'];
$andar = $_POST['andar'];
$codigo_postal = $_POST['codigo_postal'];
$cidade = $_POST['cidade'];

//Verificação se o campo da password não está preenchido
if ($_POST['new_password'] === '') {
    //actualizacao do utilizador na BD
    $query = "UPDATE users SET nome=?, apelido=?, email=?, data_nascimento=?, rua=?, numero_porta=?, andar=?,
              codigo_postal=?, cidade=?, contribuinte=? WHERE id_user=?";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'sssssssssii', $nome, $apelido, $email, $data_nascimento, $rua, $numero_porta, $andar,
        $codigo_postal, $cidade, $nif, $user_id);
} //verificação se o campo da password está preenchido
else {

    $query = "UPDATE users SET nome=?, apelido=?, email=?, password=?, data_nascimento=?, rua=?, numero_porta=?, andar=?,
             codigo_postal=?, cidade=?, contribuinte=? WHERE id_user=?";

    $stmt = mysqli_prepare($link, $query);

    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, 'ssssssssssii', $nome, $apelido, $email, $password, $data_nascimento, $rua, $numero_porta,
        $andar, $codigo_postal, $cidade, $nif, $user_id);
}

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    //	Registo válido.
    $_SESSION['user'] = $email;
    $_SESSION['nome'] = $nome;
    $_SESSION['apelido'] = $apelido;
//    $_SESSION['genero'] = $genero;
//    $_SESSION['role'] = $role;
    //$_SESSION['data_nascimento'] = $data_nascimento;
    $_SESSION['data_nascimento'] = $data_nascimento;
    $nif = $_POST['nif'];
    $_SESSION['rua'] = $rua;
    $_SESSION['numero_porta'] = $numero_porta;
    $_SESSION['andar'] = $andar;
    $_SESSION['codigo_postal'] = $codigo_postal;
    $_SESSION['cidade'] = $cidade;
    $_SESSION['registo'] = 'valido';

    header('Location: ../pages/moments.php');
} else {
    mysqli_stmt_close($stmt);
    // Registo inválido.

    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['apelido'] = $_POST['apelido'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['registo'] = 'invalido';

    header('Location: ../pages/profile.php?atualizacao=invalida');
}

//printf("Error #%d: %s.\n", mysqli_stmt_errno($stmt), mysqli_stmt_error($stmt));
//mysqli_stmt_execute($stmt);