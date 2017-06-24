<!--MAPA LOCALIZAÇÃO BIOLIVING-->
<script>
    function initMap() {
        var uluru = {lat: 40.6596295, lng: -8.5370508};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1ARZogHRRXz59P0qF89OXDH99wWtPZws&callback&callback=initMap">
</script>

<!--CONTACTOS BIOLIVING-->
<div class="row ">
    <div id="map" class="margin_nav_30" style="height: 60vh"></div>
    <div class="col s12 m12 no-margin-top">
        <div class="card">

            <div class="card-content">
                <span class="card-title">Geral</span>
                <p><i class="material-icons tiny">mail</i> geral.bioliving@gmail.com</p>
                <p><i class="material-icons tiny">home</i> Antigo Jardim de Infância de Frossos, <br>Rua do
                    Outeiro,
                    3850-612
                    Frossos<br>Albergaria-a-Velha</p>
                <p><i class="material-icons tiny">public</i><a href="www.fb.com/pg/associacaoBioLiving"
                                                               class="green-text">
                        Facebook Bioliving</a></p>

                <form class="margin-top-10" action="../components/contacts_control.php" method="post">
                    <span class="card-title">Formulário de contacto</span>
                    <div class="input-field col s12">
                        <input id="nome" type="text" class="validate" name="nome">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="assunto" type="text" class="validate" name="assunto">
                        <label for="assunto">Assunto</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="mensagem" class="materialize-textarea" name="mensagem"></textarea>
                        <label for="mensagem">Mensagem</label>
                    </div>
                    <p class="green-text" id="msg_enviada">
                        <?php
                        if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                            echo "Obrigado pelo teu contacto. Tentaremos responder assim que possível.";
                        }
                        ?>
                    </p>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="submit" name="login_form_submit" id="login_form_submit"
                                   class="waves-effect waves-light btn green" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>