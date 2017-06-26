<?php
// Ligação à BD 
require_once('../connections/connection.php');

// Get id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Definir a query
$query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto FROM produto WHERE id_produto = 1";
$result = mysqli_prepare($link, $query);


// Extrair dados da BD 
mysqli_stmt_execute($result);
mysqli_stmt_bind_result($result, $id_produto, $nome, $descricao, $preco, $ref_id_tipo_produto);

if (mysqli_stmt_fetch($result)) {

    /*Card for content*/
    echo "
        <div id=\"products_detail\" class=\"col s12 margin_nav_10\">
            <!--Galery of pictures-->
            <div class=\"carousel carousel-slider center\" data-indicators=\"true\" style=\"width: 100vw\">
                <div class=\"carousel-fixed-item center\">
                </div>
                <div class=\"carousel-item  white-text\"
                     style=\"background-image: url('../../images/store/t-shirt_small.png'); background-size: cover; background-position: center;\">
                </div>
            </div>

            <div class=\"row\">
                <div class=\"col s12 m12 no-margin-top\">
                    <div class=\"card \">
                        <div class=\"card-image\">
                        </div>
                        <div class=\"card-content\">
                            <span>$preco</span>
                            <span class=\"card-title\">$nome</span>
                            <p>$descricao</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ";
}
