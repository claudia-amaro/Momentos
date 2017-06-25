<!--Card of content - Form for moments register-->
<div class="row margin_nav_10">
    <form class="col s10 m10 offset-s1 offset-m1 margin-top-10" action="../components/moments_register_control.php" method="post">

        <h5>1. Identificação</h5>
        <div class="row">
            <div class="input-field col s12">
                <input id="moment_name" name="moment_name" data-error="" data-success="right"
                       type="text" class="validate">
                <label for="moment_name">Nome do Momento</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="moment_date" name="moment_date" type="date" data-error=""
                       data-success="right" class="validate datepicker">
                <label for="moment_date">Data</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                        <textarea id="moment_story" name="moment_story" data-error="wrong" data-success="right"
                                  class="materialize-textarea validate" data-length="500"></textarea>
                <label for="moment_story">História</label>
            </div>
        </div>

        <h5>2. Planeamento</h5>
        <div class="row">
            <div class="input-field col s12 m12">
                <select id="kit" name="kit">
                    <option value="" disabled selected>Selecione um kit</option>
                    <option value="1">Árvore + Placa de identificação + Plantação Bioliving </option>
                    <option value="2">Árvore + Placa de identificação</option>
                    <option value="3" >Placa de identificação</option>
                </select>
                <label for="kit">Selecione um kit</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12" disabled>
                <select id="local" name="local">
                    <optgroup label="Área 1">
                        <option value="1">Local 1</option>
                        <option value="2">Local 2</option>
                    </optgroup>
                    <optgroup label="Área 2">
                        <option value="3">Local 3</option>
                        <option value="4">Local 4</option>
                    </optgroup>
                </select>
                <label for="local">Local</label>
            </div>
        </div>
        <div class="row">

            <div class="input-field col s8">
                <a class="waves-effect waves-light btn green" href="tree_select.php"><i
                            class="material-icons right">chevron_right</i>escolher Árvore</a>
                <br><span class="grey-text"><i class="material-icons tiny">warning</i> Disponível consoante o local escolhido</span>

            </div>
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