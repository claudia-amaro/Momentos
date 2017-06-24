<ul id="slide-out" class="side-nav">
    <li>
        <?php
        if (isset($_SESSION['user'])) {
            $genero = $_SESSION['genero'];
            $email = $_SESSION['user'];
            $user_id = $_SESSION['user_id'];
            $nome = $_SESSION['nome'];
            $apelido = $_SESSION['apelido'];
            $result = "";

            //verificar se imagem existe
            $target_dir = "../../../../IIS_tmp/img_perfil/";
            $avatar_path = $target_dir.$user_id.".jpg";
            if (file_exists($avatar_path)) {
                //aplicar imagem perfil;
            }
            else{
                //aplicar imagem default
                if ($genero == "m") {
                    $avatar_path = "../../images/avatar_man.png";
                } else {
                    $avatar_path = "../../images/avatar_woman.png";
                }
            }

            echo "
                <div class=\"userView\">
                    <div class=\"background\">
                        <img src=\"../../images/back_small.jpg\" style=\"width: 100%;\">
                    </div>
                    <a href=\"profile.php\"><img class=\"circle\" src=\"$avatar_path\"></a>
                    <a href=\"#\"><span class=\"white-text name\">$nome $apelido</span></a><br>
                </div>
            ";
        }
        ?>
    </li>
    <li><a href="info_project.php"><i class="material-icons">nature_people</i>O Projeto</a></li>
    <li><a href="moments_register.php"><i class="material-icons">add_circle</i>Registar Momento</a></li>
    <li><a href="moments.php"><i class="material-icons">photo_library</i>Ver Momentos</a></li>
    <li><a href="moments_search.php"><i class="material-icons">search</i>Procurar Momentos</a></li>
    <li><a href="store.php"><i class="material-icons">local_offer</i>Loja</a></li>
    <li><a href="info_bioliving.php"><i class="material-icons">info</i>Associação BioLiving</a></li>
    <li>
        <div class="divider"></div>
    </li>
    <?php
    if (!isset($_SESSION['user'])) {
        echo "<li><a href=\"../pages/login_register.php\"><i class=\"material-icons\">directions_walk</i>Login/Registo</a></li>";
    }
    else {
        echo "<li><a href=\"profile.php\"><i class=\"material-icons\">person</i>Perfil</a></li>";
        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
            echo "<li><a href=\"../pages/admin_area.php\"><i class=\"material-icons\">supervisor_account</i>Área de Administrador</a></li>";
        }
        echo "<li><a href=\"../components/user_logout.php\"><i class=\"material-icons\">directions_walk</i>Logout</a></li>";
    }
    ?>
</ul>