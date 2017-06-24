<?php
// Ligação à BD 
require_once('../connections/connection.php');

?>

<div id="recents" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">

            <?php

            // Definir a query
            $query = "SELECT id_momento, nome_momento, historia, arvore, data_momento  FROM momentos ORDER BY id_momento DESC";
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
            <a href=\"moments_detail.php?id=\" class=\"black-text\">
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
                        <div class=\"divider margin-top-10\"></div>
                        <div class=\"margin-top-10\">
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i> 778</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">share</i> 13</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                        </div>
                    </div>
                </div>
            </a>
            ";
            }

            // Fechar ligação à BD 
            mysqli_close($link);
            ?>
        </div>
    </div>
</div>

<div id="mine" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">

            <?php

            // Definir a query
            /*NESTA QUERIE O NUMERO 7 DEVE SER O NUMERO CORRESPONDENTE AO UTILIZADOR DA SESSÃO */
            $query2 = "SELECT id_momento, nome_momento, historia, arvore, data_momento  FROM momentos  WHERE ref_id_user = 7  ORDER BY id_momento DESC";
            $result2 = mysqli_prepare($link, $query2);

            // Extrair dados da BD 
            $result2 = mysqli_query($link, $query2);

            //*Enquanto devolver resultados...
            while ($row_result2 = mysqli_fetch_assoc($result2)) {

                //Variáveis
                $id_momento = $row_result2["id_momento"];
                $nome_momento = $row_result2["nome_momento"];
                $historia = $row_result2["historia"];
                $arvore = $row_result2["arvore"];
                $data_momento = $row_result2["data_momento"];

                /*Card for content*/
                echo "
            <a href=\"moments_detail.php?id=\" class=\"black-text\">
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
                        <div class=\"divider margin-top-10\"></div>
                        <div class=\"margin-top-10\">
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i> 778</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">share</i> 13</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                        </div>
                    </div>
                </div>
            </a>
            ";
            }

            // Fechar ligação à BD 
            mysqli_close($link);

            ?>


        </div>
    </div>
</div>

<div id="follow" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">


        </div>
    </div>
</div>