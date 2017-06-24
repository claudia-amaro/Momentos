<div id="moments_detail" class="col s12 margin_nav_10">

    <?php

    $id_momento = $_GET['id'];

    // Ligação à BD 
    require_once('../connections/connection.php');

    // Definir a query
    $query = "SELECT nome_momento, historia, arvore, data_momento  FROM momentos  WHERE id_momento = $id_momento";
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
        <div class=\"carousel-item  white-text materialboxed\"
             style=\"background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center;\">
        </div>
        <div class=\"carousel-item  white-text materialboxed\"
             style=\"background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center;\">
        </div>
        <div class=\"carousel-item  white-text materialboxed\"
             style=\"background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center;\">
        </div>
        <div class=\"carousel-item  white-text materialboxed\"
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
                    <span><?php $data_momento ?></span>
                    <span class=\"card-title\">Nascimento do Francisco</span>
                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient
                        because I require little markup to use effectively.</p>
                    <div class=\"margin-top-10\">
                        <span style=\"display: inline-block\" class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">favorite</i> 778</span>
                        <span style=\"display: inline-block\" class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">share</i> 13</span>
                        <span style=\"display: inline-block\" class=\"valign-wrapper icon\"><i class=\"material-icons tiny\">chat</i> 42</span>
                    </div>

                </div>

                <div class=\"divider\"></div>

                <!--Comments-->
                <div class=\"comments\">
                    <div class=\"row\">
                        <div class=\"col s12\">
                            <div class=\"input-field col s3\">
                                <img class=\"circle\" src=\"../../images/avatar_woman.png\" style=\"width: 100%\">
                            </div>
                            <div class=\"input-field col s9\">
                                <div class=\"input-field\">
                                    <p class=\"nome_comentario\">Nome Utilizador<span class=\"data_comentario\">1d</span>
                                    </p>
                                </div>
                                <p>Isto é um exemplo de comentário. Isto é um exemplo de comentário. Isto é um exemplo
                                    de comentário.</p>
                            </div>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col s12\">
                            <div class=\"input-field col s3\">
                                <img class=\"circle\" src=\"../../images/avatar_woman.png\" style=\"width: 100%\">
                            </div>
                            <div class=\"input-field col s9\">
                                <div class=\"input-field\">
                                    <p class=\"nome_comentario\">Nome Utilizador<span class=\"data_comentario\">1d</span>
                                    </p>
                                </div>
                                <p>Isto é um exemplo de comentário. Isto é um exemplo de comentário. Isto é um exemplo
                                    de comentário.</p>
                            </div>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col s12\">
                            <div class=\"input-field col s3\">
                                <img class=\"circle\" src=\"../../images/avatar_woman.png\" style=\"width: 100%\">
                            </div>
                            <div class=\"input-field col s9\">
                                <div class=\"input-field\">
                                    <p class=\"nome_comentario\">Nome Utilizador<span class=\"data_comentario\">1d</span>
                                    </p>
                                </div>
                                <p>Isto é um exemplo de comentário. Isto é um exemplo de comentário. Isto é um exemplo
                                    de comentário.</p>
                            </div>
                        </div>
                    </div>

                </div>


                <!--New comment-->
                <div class=\"row\">
                    <div class=\"col s12\">
                        <div class=\"input-field col s3\">
                            <img class=\"circle\" src=\"../../images/avatar_woman.png\" style=\"width: 100%\">
                        </div>
                        <form class=\"input-field col s9\">
                            <div class=\"input-field col s8\">
                                <input placeholder=\"Escreve um comentário...\" id=\"first_name2\" type=\"text\"
                                       class=\"validate\">
                            </div>
                            <div class=\"input-field col s1\">
                                <button class=\"btn-flat waves-effect waves-light\" type=\"submit\" name=\"action\">
                                    <i class=\"material-icons\">send</i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    ";
    }
    ?>
</div>