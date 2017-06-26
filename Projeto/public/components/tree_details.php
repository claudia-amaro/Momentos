<div id="moments_detail" class="col s12 margin_nav_10">

<?php

$id_arvore = $_GET['arvore'];

// Ligação à BD 
require_once('../connections/connection.php');

// Definir a query
$query = "SELECT nome_momento, historia, arvore, data_momento  FROM produto  WHERE id_momento = $id_momento";
$result = mysqli_prepare($link, $query);

// Extrair dados da BD 
$result = mysqli_query($link, $query);

//*Enquanto devolver resultados...
while ($row_result = mysqli_fetch_assoc($result)) {
    //Variáveis
    $nome_momento = $row_result["nome_momento"];
    $historia = $row_result["historia"];
    $arvore = $row_result["arvore"];
    $data_momento = $row_result["data_momento"];

    echo "
    <!--Galery of pictures-->
    <div class=\"carousel carousel-slider center\" data-indicators=\"true\" style=\"width: 100vw\">
        <div class=\"carousel-fixed-item center\">
        </div>
        <div class=\"carousel-item  white-text\"
             style=\"background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center;\">
        </div>
        <div class=\"carousel-item  white-text \"
             style=\"background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center;\">
        </div>
        <div class=\"carousel-item  white-text \"
             style=\"background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center;\">
        </div>
        <div class=\"carousel-item  white-text\"
             style=\"background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center;\">
        </div>
    </div>

    <!--Card of content-->
    <div class=\"row\">
        <div class=\"col s12 m12 no-margin-top\">
            <div class=\"card \">
                <div class=\"card-image\">
                </div>
                <div class=\"card-content\">
                    <span>5.00€</span>
                    <span class=\"card-title\">Nome Árvore</span>
                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient
                        because I require little markup to use effectively.</p>
                </div>
            </div>

            <p class=\"margin-top-10 center grey-text\" style=\"font-size: medium\">Momentos com esta árvore</p>

            <!--Card for content-->
            <a href=\"moments_detail.php\" class=\"black-text\"><div class=\"card\">
                    <div class=\"card-image\">
                        <img src=\"../../images/back_small.jpg\">
                        <img class=\"circle right-align\" src=\"../../images/avatar_woman.png\" style=\"height: 10vh; width:10vh; float: right; margin-right: 10px; margin-top: -30px\";>
                    </div>
                    <div class=\"card-content\">
                        <span>06-09-2014 às 14h10</span>
                        <span class=\"card-title\">Nascimento do Francisco</span>
                        <p>I am good at containing small bits of information. I am convenient
                            because I require little markup to use effectively.</p>
                        <div class=\"divider margin-top-10\"></div>
                        <div class=\"margin-top-10\">
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i> 778</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">share</i> 13</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                        </div>
                    </div>
                </div>
            </a>
            <!--Card for content-->
            <a href=\"moments_detail.php\" class=\"black-text\"><div class=\"card\">
                    <div class=\"card-image\">
                        <img src=\"../../images/back_small.jpg\">
                        <img class=\"circle right-align\" src=\"../../images/avatar_woman.png\" style=\"height: 10vh; width:10vh; float: right; margin-right: 10px; margin-top: -30px\";>
                    </div>
                    <div class=\"card-content\">
                        <span>06-09-2014 às 14h10</span>
                        <span class=\"card-title\">Nascimento do Francisco</span>
                        <p>I am good at containing small bits of information. I am convenient
                            because I require little markup to use effectively.</p>
                        <div class=\"divider margin-top-10\"></div>
                        <div class=\"margin-top-10\">
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i> 778</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">share</i> 13</span>
                            <span class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>
</div>
";
}

