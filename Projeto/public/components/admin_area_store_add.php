<?php

//Registo do produto na BD
require_once('../connections/connection.php');

// Definir a query
$query = "INSERT INTO produto (nome, descricao, preco, ref_id_tipo_produto, ref_id_categoria_produto) VALUES (?,?,?,?,?)";

// Extrair dados da BD 
$stmt = mysqli_prepare($link, $query);

$nome_produto= mysqli_real_escape_string($link, $_POST['nome_produto']);
$descricao_produto =  mysqli_real_escape_string($link, $_POST['descricao_produto']);
$preco_produto =   mysqli_real_escape_string($link, $_POST['preco_produto']);
$tipo_produto = intval($_POST['tipo_produto']);
$categoria_produto = intval($_POST['categoria_produto']);

mysqli_stmt_bind_param($stmt, 'sssii', $nome_produto, $descricao_produto, $preco_produto, $tipo_produto, $categoria_produto);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: ../pages/admin_area.php');