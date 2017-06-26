<?php

$token_para_envio = $_GET["t"];

//Conversão do URL numa lista.

$query = [];

$url = parse_url($_SERVER['REQUEST_URI']);

if(isset($url['query'])){
    parse_str($url['query'], $query);
}

// ERROS

// Variáveis para guardar as mensagens de erro
$campo_password = "";
$campo_cpassword = "";

// Atribuição das mensagens às variáveis das mensagens de erro, de acordo com os erros comunicados no URL.

// CAMPO PASSWORD
if (in_array("3", $query)){
    $campo_password = "O campo password está vazio. Por favor, preenche-o.";
}
if (in_array("5", $query)){
    $campo_password = "A password deve ter entre 8 e 12 caracteres.";
}
if (in_array("6", $query)){
    $campo_password = "A password deve conter algarismos e letras maiúsculas e minúsculas.";
}
if (in_array("7", $query)){
    $campo_password = "A password deve conter algarismos e letras maiúsculas e minúsculas.";
}
if (in_array("8", $query)){
    $campo_password = "A password deve conter algarismos e letras maiúsculas e minúsculas.";
}
// CAMPO CONFIRMAR PASSWORD
if (in_array("4", $query)){
    $campo_cpassword = "O campo confirmar password está vazio. Por favor, preenche-o.";
}
if (in_array("9", $query)){
    $campo_cpassword = "Os valores introduzidos nos campos password e confirmar password não são iguais.";
}

?>

<!--FORMULÁRIO PARA REDEFINIR A PASSWORD-->

<div id="login" class="row">
        <form class="col s12" action="../components/new_password_recover_control.php?t=<?= $token_para_envio ?>" method="post" name="frmRecover" id="frmRecover">
<!--              onSubmit="return validate_forgot();">-->
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate" name="password">
                    <label for="password">Password</label>
                    <span class="green-text"></span>
                    <span class="green-text"><?= $campo_password ?></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password_confirmation" type="password" class="validate" name="cpassword">
                    <label for="password">Confirmação da Password</label>
                    <span class="green-text"></span>
                    <span class="green-text"><?= $campo_cpassword ?></span>
                </div>
            </div>

            <p class="green-text" id="msg_envio">
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                    echo "Verifica o teu email.";
                }
                ?>
            </p>
            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" name="recover_form_submit" id="recover_form_submit" class="waves-effect
                    waves-light btn green" value="Submeter">
                </div>
            </div>
        </form>
    </div>
</div>