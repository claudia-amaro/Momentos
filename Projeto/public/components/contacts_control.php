<?php

session_start();

//Lista de erros
$GLOBALS['erro'] = [];

//VALIDAÇÃO DO FORMULÁRIO
require_once '../components/contacts_form_validate.php';

//Verifica se existem erros. Se não existirem, é feito registo.
if(count($GLOBALS['erro'])==0) {

    /*SendGrid Library*/
    require_once('../../Sendgrid/vendor/autoload.php');

    /*Dados do formulário*/
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    /*Conteúdo*/
    $from = new SendGrid\Email($nome, $email);
    $subject = "Mensagem via formulário de contacto";
    $to = new SendGrid\Email("Bioliving", "bl.momentos@gmail.com");
    $content = new SendGrid\Content("text/html", "
    Email: {$email}<br>
    Nome: {$nome}<br>
    Assunto: {$assunto}<br>
    Mensagem: {$mensagem}
    ");

    /*Envio do email*/
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = ('INSERIR AQUI');
    $sg = new \SendGrid($apiKey);

    /*Resposta*/
    $resposta = $sg->client->mail()->send()->post($mail);

//Mensagem de sucesso
    header("Location: ../pages/info_bioliving.php?msg=1");
}
else{
    $erro_query_string = http_build_query($GLOBALS['erro']);

    header('Location: ../pages/info_bioliving.php?'.$erro_query_string.'&nome='.$_POST['nome'].'&email='.$_POST['email'].'&assunto='.$_POST['assunto'].'&mensagem='.$_POST['mensagem']);
}