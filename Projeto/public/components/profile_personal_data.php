<?php
//Conversão do URL numa lista.
$query = [];

$url = parse_url($_SERVER['REQUEST_URI']);

if (isset($url['query'])) {
    parse_str($url['query'], $query);
}

// ERROS

// Variáveis para guardar as mensagens de erro
$campo_nome = "";
$campo_apelido = "";
//$campo_genero = "";
$campo_email = "";
$campo_atual_password = "";
$campo_new_password = "";
$campo_c_password = "";
$campo_nif = "";
$campo_cod_postal = "";

// Atribuição das mensagens às variáveis das mensagens de erro, de acordo com os erros comunicados no URL.

// CAMPO NOME
if (in_array("1", $query)) {
    $campo_nome = "O campo está vazio. Por favor, preenche-o.";
}
if (in_array("2", $query)) {
    $campo_nome = "O limite de caracteres para este campo é 50).";
}
// CAMPO APELIDO
if (in_array("3", $query)) {
    $campo_apelido = "O campo está vazio. Por favor, preenche-o.";
}
if (in_array("4", $query)) {
    $campo_apelido = "O limite de caracteres para este campo é 50.";
}
// CAMPO EMAIL
if (in_array("7", $query)) {
    $campo_email = "O campo email está vazio. Por favor, preenche-o.";
}
if (in_array("8", $query)) {
    $campo_email = "O limite de caracteres deste campo é 100.";
}
// CAMPO PASSWORD
if (in_array("9", $query)) {
    $campo_new_password = "O campo nova password está vazio. Por favor, preenche-o.";
}
if (in_array("10", $query)) {
    $campo_new_password = "A nova password deve ter entre 8 e 12 caracteres.";
}
if (in_array("11", $query)) {
    $campo_new_password = "A nova password deve conter algarismos e letras maiúsculas e minúsculas.";
}
if (in_array("12", $query)) {
    $campo_new_password = "A nova password deve conter algarismos e letras maiúsculas e minúsculas.";
}
if (in_array("13", $query)) {
    $campo_new_password = "A nova password deve conter algarismos e letras maiúsculas e minúsculas.";
}
// CAMPO CONFIRMAR PASSWORD
if (in_array("14", $query)) {
    $campo_c_password = "O campo confirmar password está vazio. Por favor, preenche-o.";
}
if (in_array("15", $query)) {
    $campo_c_password = "Os valores introduzidos nos campos nova password e confirmar password não são iguais.";
}
if (in_array("16", $query)) {
    $campo_c_password = "Por favor, volta a preencher o campo confirmar password.";
}
if (in_array("18", $query)) {
    $campo_atual_password = "Para alterar a password, o campo atual password não pode estar vazio. Por favor, preenche-o.";
}
if (in_array("20", $query)) {
    $campo_atual_password = "O valor inserido no campo atual password não corresponde à tua passoword.";
}
if (in_array("21", $query)) {
    $campo_atual_password = "Ocorreu uma falha na verificação da atual password. Por favor tenta de novo";
}
// CAMPO NIF
if (in_array("17", $query)) {
    $campo_nif = "O NIF deve ter 9 algarismos.";
}
if (in_array("22", $query)) {
    $campo_nif = "O NIF deve ter 9 algarismos.";
}
// CAMPO CÓDIGO POSTAL
if (in_array("19", $query)) {
    $campo_cod_postal = "O código postal deve ser composto por algarismos, no formato xxxx-xxx.";
}

?>

<!--Avatar-->
<div class="row margin_nav_10" id="profile_photo">
    <?php
    if (isset($_SESSION['user'])) {
        $genero = $_SESSION['genero'];
        $email = $_SESSION['user'];
        $user_id = $_SESSION['user_id'];
        $result = "";

        //verificar se imagem existe
        $target_dir = "../../../../IIS_tmp/img_perfil/";
        $avatar_path = $target_dir . $user_id . ".jpg";
        if (file_exists($avatar_path)) {
            //aplicar imagem perfil;
        } else {
            //aplicar imagem default
            if ($genero == "m") {
                $avatar_path = "../../images/avatar_man.png";
            } else {
                $avatar_path = "../../images/avatar_woman.png";
            }
        }

        echo "<img src=\"$avatar_path\" class=\"user-image\">";
    }
    ?>
    <form action="../components/upload_profile_image.php" method="post" enctype="multipart/form-data">
        <div id="personal_data" class="input-field-photo">
            <div class="btn-floating btn waves-effect waves-light green file-field right">
                <i class="material-icons">mode_edit</i>
                <input type="file" name="upload_profile_image" id="upload_profile_image"
                       onchange="this.form.submit()">
            </div>
        </div>
    </form>

    <p class="green-text" id="msg_erro_upload_img_perfil">
        <?php
        if (isset($_GET['erro'])) {
            if ($_GET['erro'] == 1) {
                echo "Houve um erro ao carregar a imagem.";
            }
            if ($_GET['erro'] == 2) {
                echo "O ficheiro não foi carregado porque é demasiado grande.";
            }
            if ($_GET['erro'] == 3) {
                echo "Apenas são permitidos ficheiros dos formatos JPG e JPEG.";
            }
            if ($_GET['erro'] == 4) {
                echo "O ficheiro não é uma imagem.";
            }
        }
        ?>
    </p>
</div>


<div class="row">
    <form class="col s12" id="profile_data" action="../components/profile_data_control.php" method="post">

        <?php
        // Ligação à BD 
        require_once('../connections/connection.php');

        // Definir a query
        $query = "SELECT nome, apelido, genero, email, data_nascimento, rua, numero_porta, andar, codigo_postal, cidade, contribuinte FROM users WHERE email=?";
        $result = mysqli_prepare($link, $query);
        // Extrair dados da BD 
        mysqli_stmt_bind_param($result, 's', $email);
        mysqli_stmt_execute($result);
        mysqli_stmt_bind_result($result, $nome, $apelido, $genero, $email, $data_nascimento, $rua, $numero_porta, $andar, $codigo_postal, $cidade, $nif);

        if (mysqli_stmt_fetch($result)) {
            //Variáveis
            $nome_BD = $nome;
            $apelido_BD = $apelido;
            $genero_BD = $genero;
            $email_BD = $email;
            $data_nascimento_BD = $data_nascimento;
            $nif_BD = $nif;
            $rua_BD = $rua;
            $numero_porta_BD = $numero_porta;
            $andar_BD = $andar;
            $codigo_postal_BD = $codigo_postal;
            $cidade_BD = $cidade;

            mysqli_stmt_close($result);

            echo "
            <div class=\"row\">
                <div class=\"input-field col s6\">
                    <input id=\"first_name\" type=\"text\" class=\"validate\" name=\"nome\" value=\"$nome_BD\">
                    <label for=\"first_name\">Nome</label>
                    <span class=\"green-text\"> $campo_nome </span>
                </div>
                <div class=\"input-field col s6\">
                    <input id=\"last_name\" type=\"text\" class=\"validate\" name=\"apelido\" value=\"$apelido_BD\">
                    <label for=\"last_name\">Apelido</label>
                    <span class=\"green-text\"> $campo_apelido </span>
                </div>
            </div>
            
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"email\" type=\"email\" class=\"validate\" name=\"email\" value=\"$email_BD\">
                    <label for=\"email\">Email</label>
                    <span class=\"green-text\"> $campo_email</span>
                </div>
            </div>
            
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"password\" type=\"password\" class=\"validate\" name=\"atual_password\">
                    <label for=\"password\">Atual Password</label>
                    <span class=\"green-text\">$campo_atual_password</span>
                </div>
            </div>
            
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"new_password\" type=\"password\" class=\"validate\" name=\"new_password\">
                    <label for=\"new_password\">Nova Password</label>
                    <span class=\"green-text\"> $campo_new_password</span>
                </div>
            </div>
            
            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"password_confirmation\" type=\"password\" class=\"validate\" name=\"c_password\">
                    <label for=\"password_confirmation\">Confirmação da Password</label>
                    <span class=\"green-text\"> $campo_c_password</span>
                </div>
            </div>
            
            <div id=\"profile_data_others\" class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"calendar\" type=\"text\" class=\"datepicker\" name=\"data_nascimento\" value=\"$data_nascimento_BD\">
                    <label for=\"calendar\">Data de Nascimento</label>
                </div>
            </div>

            <h5 class='center margin-top-10'>Fiscal</h5>

            <div class=\"row\">
                <div class=\"input-field col s12\">
                    <input id=\"nif\" type=\"text\" class=\"validate\" name=\"nif\" value=\"$nif_BD\">
                    <label for=\"nif\">NIF</label>
                    <span class=\"green-text\">$campo_nif</span>
                </div>
            </div>

            <h5 class='center margin-top-10'>Morada</h5>

            <div id=\"user_address\" class=\"row\">
                <div class=\"input-field col s12\">
                    <input type=\"text\" class=\"validate\" id=\"rua\" name='rua' value=\"$rua_BD\">
                    <label for=\"rua\">Rua</label>
                </div>
            </div>
        
            <div class=\"row\">
                <div class=\"input-field col s6\">
                    <input type=\"text\" class=\"validate\" id=\"n_porta\" name='numero_porta' value=\"$numero_porta_BD\">
                    <label for=\"n_porta\">N.º Porta</label>
                </div>
                <div class=\"input-field col s6\">
                    <input type=\"text\" class=\"validate\" id=\"andar\" name='andar' value=\"$andar_BD\">
                    <label for=\"andar\">Andar</label>
                </div>
            </div>
            
            <div class=\"row\">
                <div class=\"input-field col s6\">
                    <input type=\"text\" class=\"validate\" id=\"cod_postal\" name='codigo_postal' value=\"$codigo_postal_BD\">
                    <label for=\"cod_postal\">Código Postal</label>
                    <span class=\"green-text\">$campo_cod_postal</span>
                </div>
                <div class=\"input-field col s6\">
                    <input type=\"text\" class=\"validate\" id=\"cidade\" name='cidade' value=\"$cidade_BD\">
                    <label for=\"cidade\">Cidade</label>
                </div>
            </div>
    </div>
    ";
        }
        ?>

        <div class="row">
            <div class="col s12"> <!--class input-field-->
                <input type="submit" name="change_profile_data" id="change_profile_data"
                       class="waves_effect waves_light btn changes-btn green" value="Alterar">
                <a href="../pages/moments.php" id="cancel_changes_profile_data"
                   class="waves_effect waves_light btn changes-btn green">Cancelar</a>
            </div>
        </div>

    </form>
</div>