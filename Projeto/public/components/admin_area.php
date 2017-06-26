<?php
// Ligação à BD 
require_once('../connections/connection.php');
?>

<!--Users-->
<div id="users" class="col s12">
    <div class="row">
        <div class="col s12 m12">

            <div class="row">
                <form class="col s12 m12">
                    <div class="card">
                        <div class="card-content" style="margin-top: 5vh">
                            <?php

                            // Definir a query
                            $query = "SELECT nome, apelido, id_user, ref_id_role, estado FROM users ORDER BY nome, apelido ASC";

                            // Extrair dados da BD 
                            $result = mysqli_query($link, $query);

                            // Mostrar dados
                            while ($row_result = mysqli_fetch_assoc($result)) {

                                //Variáveis
                                $nome = $row_result["nome"];
                                $apelido = $row_result["apelido"];
                                $id_user = $row_result["id_user"];
                                $role = $row_result["ref_id_role"];
                                $estado = $row_result["estado"];

                                echo "
                        <div class=\"row\">
                            <ul class=\"collection\">
                                <li class=\"collection-item avatar\">
                                    <img src=\"../../images/imagem1.png\" alt=\"\" class=\"circle\">
                                    <span class=\"title\">$nome $apelido</span>
                                    <div class=\"switch\">
                                        <label>
                                            Normal
                                                <input type=\"checkbox\" ";
                                                    if($role == 1)
                                                        echo "checked";
                                                echo ">
                                                <span class=\"lever\" onclick=\"window.location.href='../components/admin_area_change_role.php?a=$id_user&b=$role'\"></span>
                                            Administrador
                                        </label>
                                        ";
                                        if(isset($_GET['msg']) && (isset($_GET['a']) && $_GET['a'] == $id_user)){
                                            echo "<span class=\"green-text\">Não foi possível processar o teu pedido.</span>";
                                        }

                                        echo "
                                    </div>
                                    <a href='#delete_user?id=$id_user' class=\"secondary-content\"><i class=\"material-icons green-text\">delete</i></a>
                                    <a href='#block_user?id=$id_user' class=\"secondary-content\" style='right:50px'><i class=\"material-icons green-text\">block</i></a>
                                    
                                    <!-- Modal Structure Delete User -->
                                    <div id=\"delete_user?id=$id_user\" class=\"modal\">
                                        <div class=\"modal-content\">
                                            <h4>Atenção</h4>
                                            <p>Tem a certeza que quer eliminar este utilizador permanentemente?</p>
                                        </div>
                                        <div class=\"modal-footer\">
                                            <a href='admin_area.php#users' class='modal-action modal-close waves-effect waves-green btn-flat'>Cancelar</a>
                                            <a href=\"../components/admin_area_delete_user.php?id=$id_user\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Eliminar</a>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal Structure Block User -->
                                    <div id=\"block_user?id=$id_user\" class=\"modal\">
                                        <div class=\"modal-content\">";
                                        if ($estado == 1){
                                            echo "<h4>Atenção</h4>
                                            <p>Tens a certeza que queres bloquear este utilizador? Ele, e as suas publicações, vão deixar de estar vísiveis aos restantes utilizadores.</p>";
                                        } else{
                                            echo"<h4>Atenção</h4>
                                            <p>Tens a certeza que queres desbloquear este utilizador? Ele, e as suas publicações, vão passar a estar vísiveis aos restantes utilizadores.</p>";
                                        }
                                    echo"
                                        </div>
                                        <div class=\"modal-footer\">
                                            <a href='admin_area.php#users' class='modal-action modal-close waves-effect waves-green btn-flat'>Cancelar</a>";
                                            if ($estado == 1) {
                                                echo "<a href=\"../components/admin_area_block_user.php?id=$id_user\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Bloquear</a>";
                                            } else {
                                                echo "<a href=\"../components/admin_area_block_user.php?id=$id_user\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Desbloquear</a>";
                                            }
                                            echo "
                                            </div>
                                    </div>
				                </li>
				            </ul>
                        </div>
";
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!--Moments-->

<div id="moments" class="col s12">
    <div class="row">
        <div class="col s12 m12"  style="margin-top: 5vh">
            <?php

            // Definir a query
            $query = "SELECT id_momento, nome_momento, historia, arvore, data_momento, estado  FROM momentos ORDER BY id_momento DESC";
            $result = mysqli_prepare($link, $query);

            // Extrair dados da BD 
            $result = mysqli_query($link, $query);

            //*Enquanto devolver resultados...
            while ($row_result = mysqli_fetch_assoc($result)) {

                //Variáveis
                $id_momento = '?id='.$row_result["id_momento"];
                $nome_momento = $row_result["nome_momento"];
                $historia = $row_result["historia"];
                $arvore = $row_result["arvore"];
                $data_momento = $row_result["data_momento"];
                $estado = $row_result["estado"];

                /*Card for content*/
                echo "
            <a href=\"moments_detail.php$id_momento\" class=\"black-text\">
                <div class=\"card col s3\">
                    <div class=\"card-image\">
                        <img src=\"../../images/back_small.jpg\">
                        <img class=\"circle right-align\" src=\"../../images/avatar_woman.png\" style=\"height: 10vh; width:10vh; float: right; margin-right: 10px; margin-top: -30px;\">
                        
                        <a href='#archive_moments$id_momento' class=\"btn-floating halfway-fab right waves-effect waves-light green\" style='right: 125px'>
                         ";
                            if ($estado == 1) {
                                echo "<i class=\"material-icons\">archive</i>";
                            } else {
                                echo "<i class=\"material-icons\">unarchive</i>";
                            }
                            echo"
                        </a>
                        <a href='#delete_moments$id_momento' class=\"btn-floating halfway-fab right waves-effect waves-light green\" style='right: 80px'><i class=\"material-icons\">delete</i></a>
                    </div>
                    
                    <!-- Modal Structure Archive Moment -->
                    <div id=\"archive_moments$id_momento\" class=\"modal\">
                        <div class=\"modal-content\">";
                            if ($estado == 1){
                                echo "<h4>Atenção</h4>
                                      <p>Tens a certeza que queres ocultar este momento? Ele vai deixar de estar visível aos restantes utilizadores.</p>";
                            } else{
                                echo"<h4>Atenção</h4>
                                <p>Tens a certeza que queres mostrar este momento? Ele vai passar a estar visível aos restantes utilizadores.</p>";
                                        }
                                    echo"
                        </div>
                        <div class=\"modal-footer\">
                            <a href='admin_area.php#moments' class='modal-action modal-close waves-effect waves-green btn-flat'>Cancelar</a>";
                                if ($estado == 1) {
                                    echo "<a href=\" ../components/admin_area_archive_moment.php?id=$id_momento\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Ocultar</a>";
                                            } else {
                                                echo "<a href=\"../components/admin_area_archive_moment.php?id=$id_momento\"class=\"modal-action modal-close waves-effect waves-green btn-flat\">Mostrar</a>";
                                            }
                                            echo"
                        </div>
                    </div>
                    
                    <!-- Modal Structure Delete Moment -->
                    <div id=\"delete_moments$id_momento\" class=\"modal\">
                        <div class=\"modal-content\">
                            <h4>Atenção</h4>
                            <p>Tens a certeza que queres eliminar permanentemente este momento?</p>
                        </div>
                        <div class=\"modal-footer\">
                            <a href='admin_area.php#moments' class='modal-action modal-close waves-effect waves-green btn-flat'>Cancelar</a>
                            <a href='../components/admin_area_delete_moment.php?id=$id_momento' class=\"modal-action modal-close waves-effect waves-green btn-flat\">Eliminar</a>
                        </div>
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
            ?>
        </div>
    </div>
</div>



<!--Store-->

<div id="store" class="col s12">

    <!-- Modal Trigger -->
    <div class="fixed-action-btn">
        <a class="modal-trigger btn-floating btn-large waves-effect waves-light green modal-admin" href="#add_store"><i
                    class="material-icons">add</i></a>
    </div>

    <!-- Modal Structure -->
    <div id="add_store" class="modal modal-fixed-footer">
        <div class="modal-content">
            <!--Título e Imagem-->
            <h4>Adicionar Produto
                <div class="btn-floating btn waves-effect waves-light green file-field">
                    <i class="material-icons">file_upload</i>
                    <input type="file">
                </div>
            </h4>

            <!--Formulário-->
            <form method="post" action="../components/admin_area_store_add.php" id="adicionarProduto">

                <!--Seleção do Tipo de Produto-->
                <div class="input-field col s12">
                    <select name="tipo_produto">
                        <option value="" disabled selected>Escolhe o tipo de produto</option>
                        <option value="1">Árvores</option>
                        <option value="2">Merchandising</option>
                        <option value="3">Utilitários</option>
                    </select>
                </div>

                <!--Nome-->
                <div class="input-field col s12">
                    <input name="nome_produto" id="last_name" type="text" class="validate">
                    <label for="last_name">Nome</label>
                </div>

                <!--Descrição-->

                <div class="input-field col s12">
                    <textarea name="descricao_produto" id="textarea1" class="materialize-textarea"
                              data-length="250"></textarea>
                    <label for="textarea1">Descrição</label>
                </div>

                <!--Modalidade e Preço-->
                <div class="row">
                    <div class="btn-radio-admin col s6">
                        <label for="first_name">Categoria</label>
                        <p>
                            <input name="categoria_produto" type="radio" id="vender" value="2"/>
                            <label for="vender">Vender</label>
                        </p>
                        <p>
                            <input name="categoria_produto" type="radio" id="doar" value="1"/>
                            <label for="doar">Doar</label>
                        </p>
                    </div>
                    <div class="col s6">
                        <div class="input-field col s4">
                            <input name="preco_produto" placeholder="0000.00 €" id="first_name2" type="text"
                                   class="validate">
                            <label class="active" for="first_name2">Preço</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <a href="admin_area.php#store"
               class="modal-action modal-close waves-effect waves-green btn-flat ">Anular</a>
            <button type="submit" form="adicionarProduto"
                    class="modal-action modal-close waves-effect waves-green btn-flat ">Adicionar
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12">
            <div class="row">
                <div id="produtos" class="col s4 m12">
                    <div class="col s12 m12" style="margin-top: 5vh">
                        <?php

                        //Listar produtos da BD

                        // Definir a query
                        $query = "SELECT id_produto, nome, descricao, preco, ref_id_tipo_produto, estado FROM produto ORDER BY nome DESC";

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
                            $estado = $row_result["estado"];

                            if ($tipo_produto == 1) {
                                $tipo_produto = "Árvores";
                            } else if ($tipo_produto == 2) {
                                $tipo_produto = "Merchandising";
                            } else {
                                $tipo_produto = "Utilitários";
                            }

                            /*Card for content*/
                            echo "
            <a href=\"products_detail.php?id=$id_produto\" class=\"black-text\">
                <div class=\"card col s4\">
                    <div class=\"card-image\">
                        <img src=\"../../images/imagem1.png\">
                        <a href='' class=\"btn-floating halfway-fab right waves-effect waves-light green\" style='right: 70px'><i class=\"material-icons\">mode_edit</i></a>
                        <a href='#archive_product?id=$id_produto' class=\"btn-floating halfway-fab right waves-effect waves-light green\" style='right: 116px'>
                        ";
                            if ($estado == 1) {
                                echo "<i class=\"material-icons\">archive</i>";
                            } else {
                                echo "<i class=\"material-icons\">unarchive</i>";
                            }
                            echo "
            </a>
                        <a href='#delete_product$id_produto' class=\"btn-floating halfway-fab waves-effect waves-light green\"><i class=\"material-icons\">delete</i></a>
                    </div>

                    <!-- Modal Structure Archive Product -->
                    <div id=\"archive_product?id=$id_produto\" class=\"modal\">
                        <div class=\"modal-content\">
                        ";
                        if ($estado == 1){
                            echo "<h4>Atenção</h4>
                            <p>Tens a certeza que queres arquivar este produto? Vai deixar de estar acessível aos restantes utilizadores.</p>";
                        } else{
                            echo "<h4>Atenção</h4>
                            <p>Tens a certeza que queres desarquivar este produto? Vai passar a estar acessível aos restantes utilizadores.</p>";
                        }
                        echo"
                        </div>
                        <div class=\"modal-footer\">
                            <a href='admin_area.php#store' class='modal-action modal-close waves-effect waves-green btn-flat'>Cancelar</a>";
                            if ($estado == 1) {
                                echo "<a href='../components/admin_area_archive_product.php?id=$id_produto' class=\"modal-action modal-close waves-effect waves-green btn-flat\">Arquivar</a>";
                            } else {
                                echo "<a href='../components/admin_area_archive_product.php?id=$id_produto' class=\"modal-action modal-close waves-effect waves-green btn-flat\">Desarquivar</a>";
                            }
                            echo "
                        </div>
                    </div>
                    <!-- Modal Structure Delete Product -->
                    <div id=\"delete_product$id_produto\" class=\"modal\">
                        <div class=\"modal-content\">
                            <h4>Atenção</h4>
                            <p>Tem a certeza que quer eliminar este produto permanentemente?</p>
                        </div>
                        <div class=\"modal-footer\">
                            <a href='admin_area.php#store' class='modal-action modal-close waves-effect waves-green btn-flat'>Cancelar</a>
                            <a href='../components/admin_area_delete_product.php?id=$id_produto' class=\"modal-action modal-close waves-effect waves-green btn-flat\">Eliminar</a>
                        </div>
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>