<div id="recents" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">

            <?php
            // Ligação à BD 
            require_once('../connections/connection.php');

            // Definir a query
            $query = "SELECT id_momento, nome_momento, historia, arvore, data_momento  FROM momentos  ORDER BY id_momento DESC";
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
                echo ">chat</i> 42</span>
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


        </div>
    </div>
</div>

<div id="follow" class="col s12 min-height margin_nav_30">
    <div class="row">
        <div class="col s12 m6">


        </div>
    </div>
</div>