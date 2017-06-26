<?php
//Conversão do URL numa lista.

$query = [];

$url = parse_url($_SERVER['REQUEST_URI']);

if(isset($url['query'])){
parse_str($url['query'], $query);
}

// ERROS

// Variáveis para guardar as mensagens de erro
$campo_email = "";

// Atribuição das mensagens às variáveis das mensagens de erro, de acordo com os erros comunicados no URL.

// CAMPO EMAIL
if (in_array("1", $query)){
$campo_email = "O campo email está vazio. Por favor, preenche-o.";
}
if (in_array("2", $query)){
$campo_email = "O limite de caracteres deste campo é 100.";
}

//Variáveis para guardar os valores preenchidos nos campos de formulário após uma submissão incorreta
$nome = isset($query["email"]) ? $query["email"] : "";
//operador ternário: é o mesmo que ter
// $nome = "";
// if(isset($query["email"])) {
//   $nome = $query["nome"];
// }
$email = isset($query["email"]) ? $query["email"] : "";

?>

<!--FORMULÁRIO DE RECUPERAÇÃO DA PASSWORD-->

<div id="login" class="col s12">
    <div class="row">
        <form class="col s12" action="../components/password_recover_control.php" method="post" name="frmForgot" id="frmForgot">
                    <!--onSubmit="return validate_forgot();">-->
            <div class="input-field col s12">
                <input id="email" type="email" class="validate" name="email">
                <label for="email">Email</label>
                <span class="green-text"><?= $campo_email ?></span>
            </div>
<!--                ReCaptcha-->
                <div class="g-recaptcha col s12" data-sitekey="INSERIR AQUI"></div>

            <p class="green-text" id="msg_envio">
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                    echo "A recuperação da tua password foi enviada para o teu email.";
                }
                if (isset($_GET['msg']) && $_GET['msg'] == 2) {
                    echo "A recuperação da tua password falhou, por favor tenta de novo.";
                }
                ?>
            </p>
            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" name="forgot-password" id="forgot-password"
                           class="waves-effect waves-light btn green" value="Submeter">
                </div>
            </div>
        </form>
    </div>
</div>