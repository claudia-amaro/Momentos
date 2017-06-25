<?php
//Ligação à BD
require_once('../connections/connection.php');

////RECAPTCHA
//if (isset($_POST['g-recaptcha-response'])) {
//    $recaptcha = $_POST['g-recaptcha-response'];
//}
//
//// Se nenhum valor foi recebido é porque o utilizador não realizou o recaptcha
////if (!$recaptcha) {
////    echo "Por favor, confirme o recaptcha.";
////    exit;
////}
//
//if ($recaptcha != '') {
//    $secret_key = "COLOCAR AQUI API KEY";
//    $ip = $_SERVER['REMOTE_ADDR'];
//    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=".
//        $recaptcha."&remoteip=$ip");
//    $array = json_decode($response, true);
//    var_dump($array);
//    if ($array['success']) {
//        //true
//        echo "Obrigado por deixar sua mensagem!";
//    } else {
//        //false
//        echo "Utilizador mal intencionado detectado. A mensagem não foi enviada.";
//        //exit;
//    }
//}



//GERAR O TOKEN
$token = bin2hex(openssl_random_pseudo_bytes(16));

//criação de um timestamp de quando o token é criado
$token_criacao = date("G, Y/m/d h:i:s");

//criação da validade do token
$token_expireDate = date("G, Y/m/d H:i:s", strtotime('+48 hours'));

//var_dump($token_criacao, $token_expireDate);

//update na BD do token e da data de validade
$query2 = "UPDATE users SET token=?, token_validade=? WHERE email=?";

$stmt = mysqli_prepare($link, $query2) or die(mysqli_error($link));
mysqli_stmt_bind_param($stmt, 'sss', $a, $b, $c);

$a = $token;
$b = $token_expireDate;
$c = $email;

if (mysqli_stmt_execute($stmt)) {
    //printf("executou o stmt");

    //	Registo válido - envio do email com o link
    /*SendGrid Library*/
    require_once('../../Sendgrid/vendor/autoload.php');

    $nome_apelido = "<?php $nome_BD.\" \".$apelido_BD ?>";
    $link_recuperacao = "<?= 'new_password_recover.php?t=$token' ?>";

    /*Conteúdo*/
    $from = new SendGrid\Email("Bioliving", "bl.momentos@gmail.com");
    $subject = "Recuperação da Password";
    $to = new SendGrid\Email($nome_BD." ".$apelido_BD, $email_BD);
    $content = new SendGrid\Content("text/html", "<br>Olá $nome_apelido, <br>
        Para definir uma nova password, clique <a href='$link_recuperacao'>aqui</a>.<br>
        Relembramos que este link tem uma validade de 48 horas após a sua emissão.<br>
        Caso, já não funcione terá que solicitar o envio de um novo.
        <?php
        ");

    /*Envio do email*/
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = ('COLOCAR AQUI API KEY');
    $sg = new \SendGrid($apiKey);

    /*Resposta*/
    $resposta = $sg->client->mail()->send()->post($mail);

    //Mensagem de sucesso
    header("Location: ../pages/password_recover.php?msg=1");
}
else {
    //printf("não executou o stmt");

    // Registo inválido.
    header("Location: ../pages/password_recover.php?msg=2");
}

mysqli_stmt_close($stmt);