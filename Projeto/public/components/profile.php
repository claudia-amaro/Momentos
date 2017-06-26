<div class="row" id="test1">
    <div class="col s12">

        <!--Avatar-->
        <div class="row">
        <div id="profile_photo" class="col s12 ">
                <?php
                if (isset($_SESSION['user'])) {
                    $genero = $_SESSION['genero'];
                    $email = $_SESSION['user'];
                    $result = "";
                    if ($genero == "m") {
                        $avatar = "avatar_man.png";
                    } else {
                        $avatar = "avatar_woman.png";
                    }
                    echo "
                    <div class=\"\">
                        <img src=\"../../images/$avatar\" class=\"user-image\">
                    </div>
                ";
                }
                ?>
                <div id="personal_data" class="input-field-photo">
                    <div class="btn-floating btn-large waves-effect waves-light green file-field">
                        <i class="material-icons">mode_edit</i>
                        <input type="file">
                    </div>
                </div>
            </div>
        </div>

        <div class="divider col s12">
            <div class="row"></div>
        </div>

        <form class="col s12" action="../components/profile_data_control.php" method="post">
            <div id="profile_data" class="col s12">
                <div class="row">

                    <?php
                    // Ligação à BD 
                    require_once('../connections/connection.php');

                    // Definir a query
                    $query = "SELECT nome, apelido, genero, email, data_nascimento, rua, numero_porta, andar, codigo_postal, cidade FROM users WHERE email=?";
                    $result = mysqli_prepare($link, $query);
                    // Extrair dados da BD 
                    mysqli_stmt_bind_param($result, 's', $email);
                    mysqli_stmt_execute($result);
                    mysqli_stmt_bind_result($result, $nome, $apelido, $genero, $email, $data_nascimento, $rua, $numero_porta, $andar, $codigo_postal, $cidade);

                    if (mysqli_stmt_fetch($result)) {
                        //Variáveis
                        $nome_BD = $nome;
                        $apelido_BD = $apelido;
                        $genero_BD = $genero;
                        $email_BD = $email;
                        $data_nascimento_BD = $data_nascimento;
                        $rua_BD = $rua;
                        $numero_porta_BD = $numero_porta;
                        $andar_BD = $andar;
                        $codigo_postal_BD = $codigo_postal;
                        $cidade_BD = $cidade;

                        echo "
            <div class=\"input-field col s6\">
                <input id=\"first_name\" type=\"text\" class=\"validate\" name=\"nome\" value=\"$nome_BD\">
                <label for=\"first_name\">Nome</label>
            </div>
            <div class=\"input-field col s6\">
                <input id=\"last_name\" type=\"text\" class=\"validate\" name=\"apelido\" value=\"$apelido_BD\">
                <label for=\"last_name\">Apelido</label>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"input-field col s12\">
                <input id=\"email\" type=\"email\" class=\"validate\" name=\"email\" value=\"$email_BD\">
                <label for=\"email\">Email</label>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"input-field col s12\">
                <input id=\"password\" type=\"password\" class=\"validate\" name=\"password\">
                <label for=\"password\">Atual Password</label>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"input-field col s12\">
                <input id=\"new_password\" type=\"password\" class=\"validate\" name=\"new_password\">
                <!--FALTA CONFIRMAR SE A PASSWORD É IGUAL-->
                <label for=\"new_password\">Nova Password</label>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"input-field col s12\">
                <input id=\"password_confirmation\" type=\"password\" class=\"validate\" name=\"cpassword\">
                <!--FALTA CONFIRMAR SE A PASSWORD É IGUAL-->
                <label for=\"password_confirmation\">Confirmação da Password</label>
            </div>
        </div>
    </div>

    <div class=\"divider col s12\">
        <div class=\"row\"></div>
    </div>

    <div id=\"profile_data_others\" class=\"col s12\">
        <div class=\"row\">
            <div class=\"input-field col s12\">
                <input id=\"calendar\" type=\"text\" class=\"datepicker\" name=\"data_nascimento\" value=\"$data_nascimento_BD\">
                <label for=\"calendar\">Data de Nascimento</label>
            </div>
        </div>
    </div>

    <div class=\"divider col s12\">
        <div class=\"row\"></div>
    </div>

    <div id=\"user_address\" class=\"col s12\">
        <div class=\"row\">
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
                        <div class="input-field col s12">
                            <input type="submit" name="change_profile_data" id="change_profile_data"
                                   class="waves_effect waves_light btn changes-btn green" value="Alterar">
                            <input type="submit" name="cancel_changes_profile_data" id="cancel_changes_profile_data"
                                   class="waves_effect waves_light btn changes-btn green" value="Cancelar">
                        </div>
                    </div>

        </form>
    </div>
</div>
</div>