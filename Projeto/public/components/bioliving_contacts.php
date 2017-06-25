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
$campo_email = "";
$campo_assunto = "";
$campo_mensagem = "";

// Atribuição das mensagens às variáveis das mensagens de erro, de acordo com os erros comunicados no URL.

// CAMPO NOME
if (in_array("1", $query)){
    $campo_nome = "O campo nome está vazio. Por favor, preenche-o.";
}
if (in_array("2", $query)){
    $campo_nome = "O campo nome deve ter entre 3 e 50 caracteres.";
}
// CAMPO EMAIL
if (in_array("3", $query)){
    $campo_email = "O campo email está vazio. Por favor, preenche-o.";
}
if (in_array("4", $query)){
    $campo_email = "O limite de caracteres deste campo é 100.";
}
// CAMPO ASSUNTO
if (in_array("5", $query)){
    $campo_assunto = "O campo assunto está vazio. Por favor, preenche-o.";
}
if (in_array("6", $query)){
    $campo_assunto = "O campo assunto deve ter entre 3 e 50 caracteres.";
}
// CAMPO MENSAGEM
if (in_array("7", $query)){
    $campo_mensagem = "O campo mensagem está vazio. Por favor, preenche-o.";
}
if (in_array("8", $query)){
    $campo_mensagem = "O campo mensagem deve ter entre 3 e 500 caracteres.";
}

//Variáveis para guardar os valores preenchidos nos campos de formulário após uma submissão incorreta
$nome = isset($query["nome"]) ? $query["nome"] : "";
//operador ternário: é o mesmo que ter
// $nome = "";
// if(isset($query["nome"])) {
//   $nome = $query["nome"];
// }
$email = isset($query["email"]) ? $query["email"] : "";
$assunto = isset($query["assunto"]) ? $query["assunto"] : "";
$mensagem = isset($query["mensagem"]) ? $query["mensagem"] : "";

?>

<!--MAPA LOCALIZAÇÃO BIOLIVING-->
<script>
    function initMap() {
        var uluru = {lat: 40.6596295, lng: -8.5370508};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1ARZogHRRXz59P0qF89OXDH99wWtPZws&callback&callback=initMap">
</script>

<!--CONTACTOS BIOLIVING-->
<div class="row ">
    <div id="map" class="margin_nav_30" style="height: 60vh"></div>
    <div class="col s12 m12 no-margin-top">
        <div class="card">

            <div class="card-content">
                <span class="card-title">Geral</span>
                <p><i class="material-icons tiny">mail</i> geral.bioliving@gmail.com</p>
                <p><i class="material-icons tiny">home</i> Antigo Jardim de Infância de Frossos, <br>Rua do
                    Outeiro,
                    3850-612
                    Frossos<br>Albergaria-a-Velha</p>
                <p><i class="material-icons tiny">public</i><a href="www.fb.com/pg/associacaoBioLiving"
                                                               class="green-text">
                        Facebook Bioliving</a></p>

                <form class="margin-top-10" action="../components/contacts_control.php" method="post">
                    <span class="card-title">Formulário de contacto</span>
                    <div class="input-field col s12">
                        <input id="nome" type="text" class="validate" name="nome" value="<?= $nome ?>">
                        <label for="nome">Nome</label>
                        <span class="green-text"><?= $campo_nome ?></span>
                    </div>
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate" name="email" value="<?= $email ?>">
                        <label for="email">Email</label>
                        <span class="green-text"><?= $campo_email ?></span>
                    </div>
                    <div class="input-field col s12">
                        <input id="assunto" type="text" class="validate" name="assunto" value="<?= $assunto ?>">
                        <label for="assunto">Assunto</label>
                        <span class="green-text"><?= $campo_assunto ?></span>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="mensagem" class="materialize-textarea" name="mensagem"><?= $mensagem ?></textarea>
                        <label for="mensagem">Mensagem</label>
                        <span class="green-text"><?= $campo_mensagem ?></span>
                    </div>
                    <p class="green-text" id="msg_enviada">
                        <?php
                        if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                            echo "Obrigado pelo teu contacto. Tentaremos responder assim que possível.";
                        }
                        ?>
                    </p>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="submit" name="login_form_submit" id="login_form_submit"
                                   class="waves-effect waves-light btn green" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>