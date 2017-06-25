<?php

//Conversão do URL numa lista.

$query = [];

$url = parse_url($_SERVER['REQUEST_URI']);

if(isset($url['query'])){
    parse_str($url['query'], $query);
}

// ERROS

// Variáveis para guardar as mensagens de erro
$campo_nome = "";
$campo_apelido = "";
$campo_genero = "";
$campo_email = "";
$campo_password = "";
$campo_cpassword = "";

// Atribuição das mensagens às variáveis das mensagens de erro, de acordo com os erros comunicados no URL.

// CAMPO NOME
if (in_array("1", $query)){
    $campo_nome = "O campo está vazio. Por favor, preenche-o.";
}
if (in_array("2", $query)){
    $campo_nome = "O limite de caracteres para este campo é 50).";
}
// CAMPO APELIDO
if (in_array("3", $query)){
    $campo_apelido = "O campo está vazio. Por favor, preenche-o.";
}
if (in_array("4", $query)){
    $campo_apelido = "O limite de caracteres para este campo é 50.";
}
// CAMPO GÉNERO
if (in_array("5", $query)){
    $campo_genero = "Por favor, selecione o género.";
}// CAMPO EMAIL
if (in_array("7", $query)){
    $campo_email = "O campo email está vazio. Por favor, preenche-o.";
}
if (in_array("8", $query)){
    $campo_email = "O limite de caracteres deste campo é 100.";
}
// CAMPO PASSWORD
if (in_array("9", $query)){
    $campo_password = "O campo password está vazio. Por favor, preenche-o.";
}
if (in_array("10", $query)){
    $campo_password = "A password deve ter entre 8 e 12 caracteres.";
}
if (in_array("11", $query)){
    $campo_password = "A password deve conter algarismos e letras maiúsculas e minúsculas.";
}
if (in_array("12", $query)){
    $campo_password = "A password deve conter algarismos e letras maiúsculas e minúsculas.";
}
if (in_array("13", $query)){
    $campo_password = "A password deve conter algarismos e letras maiúsculas e minúsculas.";
}
// CAMPO CONFIRMAR PASSWORD
if (in_array("14", $query)){
    $campo_cpassword = "O campo confirmar password está vazio. Por favor, preenche-o.";
}
if (in_array("15", $query)){
    $campo_cpassword = "Os valores introduzidos nos campos password e confirmar password não são iguais.";
}
if (in_array("16", $query)){
    $campo_cpassword = "Por favor, volta a preencher o campo confirmar password.";
}


//Registo inválido. Se o registo for inválido (informação que vem no URL), a variável $registo = "invalido".
$registo = "";
if(isset($_GET['registo'])){
    $registo = "Registo inválido. O email escolhido já foi utilizado anteriormente."; // Em princípio, esse é o problema. (Mas esta solução deve ser alterada.)
    $campo_cpassword = "Por favor, volta a preencher os campos password e confirmar password.";
}

//Variáveis para guardar os valores preenchidos nos campos de formulário após uma submissão incorreta
$nome = "";
$apelido = "";
$genero = "";
$email = "";
$cpassword = "";

if(isset($_SESSION['registo'])) {
    $nome = $_SESSION['nome'];
    $apelido = $_SESSION['apelido'];
    $email = $_SESSION['email'];
}
?>

<!--FORMULÁRIO DE REGISTO-->

<div class="row" xmlns="http://www.w3.org/1999/html">
    <!--Se o registo for inválido, $registo="invalido". Caso contrário, $registo ="". -->
    <p class="green-text"><?= $registo ?></p>
    <form class="col s12" action="../components/register_control.php" method="post">
        <div class="row">
            <div class="input-field col s6">
                <input id="first_name" type="text" class="validate" name="nome" value=<?= $nome ?>>
                <label for="first_name">Nome</label>
                <span class="green-text"><?= $campo_nome ?></span>
            </div>
            <div class="input-field col s6">
                <input id="last_name" type="text" class="validate" name="apelido" value=<?= $apelido ?>>
                <label for="last_name">Apelido</label>
                <span class="green-text"><?= $campo_apelido ?></span>
            </div>
        </div>
        <div class="row radio_genero">
            <span class="radio_label">Género:</span>
        </div>
        <div class="row radio_genero">
            <?php
            if(isset($_SESSION['genero'])) {
                if ($_SESSION['genero'] == "m") {
                    echo "<p>
                            <input name=\"genero\" type=\"radio\" value=\"m\" id=\"genero_masculino\" checked />
                            <label for=\"genero_masculino\">Masculino</label>
                          </p>";
                }
                else {
                    echo "<p>
                        <input name=\"genero\" type=\"radio\" value=\"m\" id=\"genero_masculino\" />
                        <label for=\"genero_masculino\">Masculino</label>
                      </p>";
                }
                if ($_SESSION['genero'] == "f") {
                    echo "<p>
                            <input name=\"genero\" type=\"radio\" value=\"f\" id=\"genero_feminino\" checked/>
                            <label for=\"genero_feminino\">Feminino</label>
                          </p>";
                }
                else{
                    echo "<p>
                        <input name=\"genero\" type=\"radio\" value=\"m\" id=\"genero_feminino\" />
                        <label for=\"genero_feminino\">Feminino</label>
                      </p>";
                }
            }
            else{
                echo "<p>
                        <input name=\"genero\" type=\"radio\" value=\"m\" id=\"genero_masculino\" />
                        <label for=\"genero_masculino\">Masculino</label>
                      </p>
                      <p>
                        <input name=\"genero\" type=\"radio\" value=\"f\" id=\"genero_feminino\" />
                        <label for=\"genero_feminino\">Feminino</label>
                      </p>";
            }
            ?>
            <span class="green-text"><?= $campo_genero ?></span>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="email" type="email" class="validate" name="email" value=<?= $email ?>>
                <label for="email">Email</label>
                <span class="green-text"><?= $campo_email ?></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="password" type="password" class="validate" name="password">
                <label for="password">Password</label>
                <span class="green-text"><?= $campo_password ?></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="password_confirmation" type="password" class="validate" name="cpassword">
                <label for="password">Confirmação da Password</label>
                <span class="green-text"><?= $campo_cpassword ?></span>
            </div>
        </div>
        <!--        <p class="green-text" id= "msg_validação_registo"> -->

        <div class="row">
            <div class="input-field col s12">
                <input type="submit" name="register_form_submit" id="register_form_submit" class="waves-effect waves-light btn green" value="Submeter">
            </div>
        </div>
    </form>
</div>