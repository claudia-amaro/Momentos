<div class="row margin_nav_30">

    <div id="produtos" class="col s12 m12">

        <!-- Dropdown Trigger -->
        <a class='dropdown-button btn white grey-text margin-top-10' style="width: 100%" href='#' data-activates='dropdown1'><i
                    class="material-icons left">filter_list</i>Filtrar por...<i class="material-icons right">keyboard_arrow_down</i></a>

        <!-- Dropdown Structure -->
        <ul id='dropdown1' class='dropdown-content '>
            <li><a href="#!" class="grey-text">Para doar</a></li>
            <li><a href="#!" class="grey-text">Para aquisição</a></li>
        </ul>

        <!--Dropdown-->
        <!--        <div class="input-field col s12">
                    <select>
                        <option value="" disabled selected>Filtrar por...</option>
                        <option value="1">Para doar</option>
                        <option value="2">Para aquisição</option>
                    </select>
                </div>
        -->

<!--
Ao clicar em doar:
        $query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto FROM produto WHERE ref_id_categoria_produto = 1 ORDER BY nome ASC";
Ao clicar em aquisição:
        $query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto FROM produto WHERE ref_id_categoria_produto = 2 ORDER BY nome ASC";
arvores:
        $query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto FROM produto WHERE ref_id_tipo_produto = 1 ORDER BY nome ASC";
merchandising:
        $query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto FROM produto WHERE ref_id_tipo_produto = 2 ORDER BY nome ASC";
utilitarios:
        $query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto FROM produto WHERE ref_id_tipo_produto = 3 ORDER BY nome ASC";
-->

        <?php
        // Ligação à BD 
        require_once('../connections/connection.php');

        // Definir a query
        $query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto FROM produto ORDER BY nome DESC";
        $result = mysqli_prepare($link, $query);

        // Extrair dados da BD 
        $result = mysqli_query($link, $query);

        //*Enquanto devolver resultados...
        while ($row_result = mysqli_fetch_assoc($result)) {

            //Variáveis
            $id_produto = $row_result["id_produto"];
            $nome = $row_result["nome"];
            $descricao = $row_result["descricao"];
            $preco = $row_result["preco"];
            $tipo_produto = $row_result["ref_id_tipo_produto"];

            /*Card for content*/
            echo "
            <a href=\"products_detail.php?id=$id_produto\" class=\"black-text\">        
                <div class=\"card\">
                    <div class=\"card-image\">
                        <img src=\"../../images/imagem1.png\">
                    </div>
                    <div class=\"card-content\">
                        <span>$tipo_produto</span>
                        <span class=\"card-title\">$nome</span>
                        <p>$descricao<br>$preco</p>
                    </div>
                </div>
            </a>
            ";
        }

        // Fechar ligação à BD 
        mysqli_close($link);

        ?>

        <div>
            <p class="center-align"><a href="#" class="green-text"><i class="material-icons">arrow_upward</i><br>Voltar
                    ao topo</a></p>
        </div>
    </div>

    <div class="row">
        <div id="carrinho" class="col s12 m12 center">
            <p class="valign">Não tem produtos no carrinho.</p>
        </div>
    </div>

</div>