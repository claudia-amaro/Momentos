<?php

if(isset($_GET["id_invalido"])){
    echo "<div class=\"row\">
            <p class=\"green-text margin-top-10 col s10 offset-s1\">Introduza um id válido.</p>
          </div>";
}
?>


<form class="col s12" action="../components/search_id_control.php" method="GET">

    <div class="row margin-top-10">

        <div class="input-field col s10 offset-s1">
            <input id="id" type="text" class="validate" name="id">
            <label for="id">ID</label>
        </div>

        <div class="input-field col s10 offset-s1">
            <i class="waves-effect waves-light btn green waves-input-wrapper"><input style="margin-top: 8px" type="submit" id="login_form_submit" class="waves-button-input" value="Procurar"></i>
        </div></div>

</form>