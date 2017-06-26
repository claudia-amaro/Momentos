<?php
// Ligação à BD 
require_once('../connections/connection.php');

?>

<div id="recents" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">

            <!--<div id="recents_content"></div>-->

            <?php
            // Definir a query
            $query = "SELECT id_momento, nome_momento, historia, arvore, data_momento FROM momentos ORDER BY data_momento DESC";
            $result = mysqli_prepare($link, $query);

            // Extrair dados da BD 
            $result = mysqli_query($link, $query);

            //*Enquanto devolver resultados...
            while ($row_result = mysqli_fetch_assoc($result)) {

                //Variáveis
                $id_momento = $row_result["id_momento"];
                $nome_momento = $row_result["nome_momento"];
                $historia = $row_result["historia"];
                $arvore = $row_result["arvore"];
                $data_momento = $row_result["data_momento"];

                /*Card for content*/
                echo "
            <a href=\"moments_detail.php?id=$id_momento\" class=\"black-text\">
                <div class=\"card\">
                    <div class=\"card-image\">
                        <img src=\"../../images/back_small.jpg\">
                        <img class=\"circle right-align\" src=\"../../images/avatar_woman.png\"
                        style=\"height: 10vh; width:10vh; float: right; margin-right: 10px; margin-top: -30px;\">
                    </div>
                    <div class=\"card-content\">
                        <span>$data_momento</span>
                        <span class=\"card-title\">$nome_momento</span>
                        <p>$historia</p>
                        <div class=\"divider margin-top-10\">
                    </div>
                    <div class=\"margin-top-10\">
                        <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i></span>
                        <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                    </div>
                </div>
        </div>
        </a>
        ";
            }
            ?>

        </div>
    </div>
</div>

<div id="mine" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">
            <?php

            // Definir a query
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                $query2 = "SELECT id_momento, nome_momento, historia, arvore, data_momento  FROM momentos  WHERE ref_id_user = $user_id ORDER BY data_momento DESC";
                $result2 = mysqli_prepare($link, $query2);

                // Extrair dados da BD 
                $result2 = mysqli_query($link, $query2);

                //*Enquanto devolver resultados...
                if ($row_result2 = mysqli_fetch_assoc($result2)) {

                    do{
                        //Variáveis
                        $id_momento = $row_result2["id_momento"];
                        $nome_momento = $row_result2["nome_momento"];
                        $historia = $row_result2["historia"];
                        $arvore = $row_result2["arvore"];
                        $data_momento = $row_result2["data_momento"];

                        //verificar se imagem existe
                        $target_dir = "../../../../IIS_tmp/img_perfil/";
                        $avatar_path = $target_dir . $user_id . ".jpg";
                        if (file_exists($avatar_path)) {
                            //aplicar imagem perfil;
                        }

                        /*Card for content*/
                        echo "
                <a href=\"moments_detail.php?id=$id_momento\" class=\"black-text\">
                    <div class=\"card\">
                        <div class=\"card-image\">
                            <img src=\"../../images/back_small.jpg\">
                            <img class=\"circle\" src=\"$avatar_path\"
                                 style=\"height: 10vh; width:10vh; float: right; margin-right: 10px; margin-top: -30px; border-radius: 50%\">
                        </div>
                        <div class=\"card-content\">
                            <span>$data_momento</span>
                            <span class=\"card-title\">$nome_momento</span>
                            <p>$historia</p>
                            <div class=\"divider margin-top-10\"></div>
                            <div class=\"margin-top-10\">
                                <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i> 778</span>
                                <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                            </div>
                        </div>
                    </div>
                </a>
                ";

                    }while($row_result2 = mysqli_fetch_assoc($result2));

                } else {
                    /*Card for content*/
                    echo "
                    <div class='row valign-wrapper' style='height: 60vh !important;'>
                        <p class='col s10 offset-s1 center'>Ainda não tens nenhum momento registado. 
                        <br><br><a href='moments_register.php' class='btn green margin-top-10'>Registar Momento</a>
                    </div>
                
                ";
                }
            } else {
                /*Card for content*/
                echo "
                    <div class='row valign-wrapper' style='height: 60vh !important;'>
                        <p class='col s10 offset-s1 center'>Faz login ou regista-te para poderes ver esta página. 
                        <br><br><a href='../pages/login_register.php' class='btn green margin-top-10'>Login/Registo</a>
                    </div>
                
                ";
            }
            ?>
        </div>
    </div>
</div>

<div id="follow" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">

            <?php

            // Definir a query
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                $query3 = "SELECT a_seguir.ref_id_user, a_seguir.ref_id_momento, momentos.id_momento, momentos.nome_momento, momentos.historia, momentos.arvore, momentos.data_momento  FROM a_seguir  INNER JOIN momentos ON a_seguir.ref_id_momento = momentos.id_momento WHERE a_seguir.ref_id_user = $user_id ORDER BY data_momento DESC";
                $result3 = mysqli_prepare($link, $query3);

                // Extrair dados da BD 
                $result3 = mysqli_query($link, $query3);

                //*Enquanto devolver resultados...
                if ($row_result3 = mysqli_fetch_assoc($result3)) {

                    do{
                        //Variáveis
                        $id_momento = $row_result3["id_momento"];
                        $nome_momento = $row_result3["nome_momento"];
                        $historia = $row_result3["historia"];
                        $arvore = $row_result3["arvore"];
                        $data_momento = $row_result3["data_momento"];

                        //verificar se imagem existe
                        $target_dir = "../../../../IIS_tmp/img_perfil/";
                        $avatar_path = $target_dir . $user_id . ".jpg";
                        if (file_exists($avatar_path)) {
                            //aplicar imagem perfil;
                        }

                        /*Card for content*/
                        echo "
                <a href=\"moments_detail.php?id=$id_momento\" class=\"black-text\">
                    <div class=\"card\">
                        <div class=\"card-image\">
                            <img src=\"../../images/back_small.jpg\">
                            <img class=\"circle right-align\" src=\"../../images/$avatar_path\"
                                 style=\"height: 10vh; width:10vh; float: right; margin-right: 10px; margin-top: -30px;\">
                        </div>
                        <div class=\"card-content\">
                            <span>$data_momento</span>
                            <span class=\"card-title\">$nome_momento</span>
                            <p>$historia</p>
                            <div class=\"divider margin-top-10\"></div>
                            <div class=\"margin-top-10\">
                                <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i> 778</span>
                                <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                            </div>
                        </div>
                    </div>
                </a>
                ";

                    }while($row_result2 = mysqli_fetch_assoc($result3));

                } else {
                    /*Card for content*/
                    echo "
                    <div class='row valign-wrapper' style='height: 60vh !important;'>
                        <p class='col s10 offset-s1 center'>Ainda não segues nenhum momento. 
                        <br><br><a href='moments.php' class='btn green margin-top-10'>Ver Momentos</a>
                    </div>
                
                ";
                }
            } else {
                /*Card for content*/
                echo "
                    <div class='row valign-wrapper' style='height: 60vh !important;'>
                        <p class='col s10 offset-s1 center'>Regista-te na aplicação para poderes ver esta página. 
                        <br><br><a href='../pages/login_register.php' class='btn green margin-top-10'>Registar-me</a>
                    </div>
                
                ";
            }
            ?>

        </div>
    </div>
</div>