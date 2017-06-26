<!--Card of content - Form for moments register-->
<div class="row margin_nav_10">








    <form class="col s10 m10 offset-s1 offset-m1 margin-top-10" action="../components/moments_register_control.php" method="post">

        <h5>1. Identificação</h5>
        <div class="row">
            <div class="input-field col s12">
                <input id="nome_momento" name="nome_momento" data-error="" data-success="right"
                       type="text" class="validate">
                <label for="moment_name">Nome do Momento</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="data_momento" name="data_momento" type="date" data-error=""
                       data-success="right" class="validate datepicker">
                <label for="moment_date">Data</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                        <textarea id="historia" name="historia" data-error="wrong" data-success="right"
                                  class="materialize-textarea validate" data-length="500"></textarea>
                <label for="moment_story">História</label>
            </div>
        </div>


        <h5>2. Planeamento</h5>
        <div class="row">
            <div class="input-field col s12 m12">
                <select id="kit" name="kit" onchange="calcular();">

<!--                    --><?php
//                    if(isset($_SESSION['kit'])) {
//                    if ($_SESSION['kit'] == "1") {
//                            echo "<p>
//                <option disabled>Selecione um kit</option>
//                <option onclick=\"\" value=\"1\" selected>Árvore + Placa de identificação + Plantação Bioliving </option>
//                <option value=\"2\">Árvore + Placa de identificação</option>
//                <option value=\"3\" >Placa de identificação</option>
//            </p>";
//                        }
//                        else if ($_SESSION['kit'] == "2") {
//                            echo "<p>
//                <option disabled>Selecione um kit</option>
//                <option onclick=\"\" value=\"1\">Árvore + Placa de identificação + Plantação Bioliving </option>
//                <option value=\"2\" selected>Árvore + Placa de identificação</option>
//                <option value=\"3\" >Placa de identificação</option>
//            </p>";
//                        }
//                        else{
//                            echo "<p>
//                <option disabled>Selecione um kit</option>
//                <option onclick=\"\" value=\"1\">Árvore + Placa de identificação + Plantação Bioliving </option>
//                <option value=\"2\" >Árvore + Placa de identificação</option>
//                <option value=\"3\" selected >Placa de identificação</option>
//            </p>";
//                        }
//                    }
//                    else {
//                        echo "<p>
//            <option disabled selected>Selecione um kit</option>
//            <option onclick=\"\" value=\"1\">Árvore + Placa de identificação + Plantação Bioliving </option>
//            <option value=\"2\">Árvore + Placa de identificação</option>
//            <option value=\"3\">Placa de identificação</option>
//        </p>";}
//                    ?>
                    <option disabled selected>Selecione um kit</option>
                    <option value="1">Árvore + Placa de identificação + Plantação Bioliving </option>
                    <option value="2">Árvore + Placa de identificação</option>
                    <option value="3" >Placa de identificação</option>
                </select>
                <label for="kit">Selecione um kit</label>
            </div>
        </div>





        <script>

            function calcular() {

                var a = document.getElementById("kit");
                var b = a.options[a.selectedIndex].value;
//              alert(b);
//              var c = e.options[e.selectedIndex].text;


                switch(b){
                    case "1":
                        document.getElementById("compras").innerHTML = "placa de identificação: 20.00€<br>Plantação: 25.00 €";
                        document.getElementById("btn_escolher").innerHTML = "<a  type='submit' class='waves-effect waves-light btn green' href='tree_select.php'><i class='material-icons right'>chevron_right</i>escolher Árvore</a>";
                        break;
                    case "2":
                        document.getElementById("compras").innerHTML = "placa de identificação: 20.00€";
                        document.getElementById("btn_escolher").innerHTML = "<a  type='submit' class='waves-effect waves-light btn green' href='tree_select.php'><i class='material-icons right'>chevron_right</i>escolher Árvore</a>";
                        break;
                    case "3":
                        document.getElementById("compras").innerHTML = "placa de identificação: 20.00€";
                        document.getElementById("btn_escolher").innerHTML = "<a  type='submit' class='waves-effect waves-light btn green' href='tree_select.php' disabled=''><i class='material-icons right'>chevron_right</i>escolher Árvore</a>";
                        break;
                }

            }

        </script>

        <div class="row">
            <div class="input-field col s12" disabled>
                <select id="local" name="local">
                    <option value="" disabled selected>Selecione um local</option>
                        <?php

                        // Ligação à BD 
                            require_once('../connections/connection.php');

                            $query = "SELECT id_local, freguesia, concelho, distrito FROM locais";
                            $result = mysqli_query($link, $query);

                            // Mostrar dados
                            while ($row_result = mysqli_fetch_assoc($result)) {
                                $id_local = $row_result["id_local"];
                                $freguesia = $row_result["freguesia"];
                                $concelho = $row_result["concelho"];
                                $distrito = $row_result["distrito"];

                                echo "<option value=$id_local>$distrito - $concelho - $freguesia</option>";
                            }
                        ?>
                </select>
                <label for="local">Local</label>
            </div>
        </div>
        <div class="row">

            <p class="col s8" >Escolha uma árvore<p>

            <div id="btn_escolher" class="input-field col s8">

                <a  type="submit" class="waves-effect waves-light btn green" href="tree_select.php" disabled><i
                            class="material-icons right">chevron_right</i>escolher Árvore</a>
<!--                <br><span class="grey-text"><i class="material-icons tiny">warning</i> Disponível consoante o local escolhido</span>-->

            </div>

            <?php
                if(isset($_GET['nome_arvore'])){
                    $nome_arvore = $_GET['nome_arvore'];
                    $preco = $_GET['preco'];
                    echo "<div class=\"input-field col s8\"><p>$nome_arvore</p></div>
                          <input name=\"$nome_arvore\" type=\"hidden\">";
                }
            ?>


            <div class="input-field col s4">
                <input id="tree_number" name="tree_number" data-error="wrong" data-success="right"
                       type="text" class="validate" value="01" disabled>
                <label for="tree_number">Quantidade</label>
                <!--    <input type="number" min="1" max="18" step="1" value="1" name="numero">-->
            </div>
        </div>



        <h5>3. Confirmação</h5>
        <div class="row">
            <div class="input-field col s12" disabled>

<!--                Listar a "compra"-->
                <div id="compras"></div>

                <?php
                if(isset($_GET['nome_arvore'])){
                    $nome_arvore = $_GET['nome_arvore'];
                    $preco = $_GET['preco'];
                    echo "<div>$nome_arvore: $preco</div>";
                }
                ?>

            </div>
        </div>

        <!--Submeter-->
        <div class="row">
            <div class="input-field col s12">
                <input type="submit" name="register_form_submit" id="register_form_submit"
                       class="waves-effect waves-light btn green" value="Submeter">
            </div>
        </div>

    </form>

</div>