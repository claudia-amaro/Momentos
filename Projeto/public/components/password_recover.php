<!--FORMULÁRIO DE RECUPERAÇÃO DA PASSWORD-->

<div id="login" class="col s12">
    <div class="row">
        <form class="col s12" action="../components/password_recover_control.php" method="post" name="frmForgot" id="frmForgot">
                    <!--onSubmit="return validate_forgot();">-->
            <div class="input-field col s12">
                <input id="email" type="text" class="validate" name="email">
                <label for="email">Email</label>
            </div>
                <!--ReCaptcha-->
                <!--<div class="g-recaptcha col s12" data-sitekey="6LdzaSYUAAAAAAvl5fsQcL8X21kF7PYi3rYBrKvi"></div>-->

            <p class="green-text" id="msg_envio">
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                    echo "A recuperação da tua password foi enviada para o teu email.";
                }
                if (isset($_GET['msg']) && $_GET['msg'] == 2) {
                    echo "A recuperação da tua password falhou, por favor tenta de novo.";
                }
                ?>
            </p>
            <div class="row">
                <!--botão de submit com recaptcha-->
                <!--<button class="g-recaptcha input-field col s12 waves-effect waves-light btn green"-->
                <!--data-sitekey="6LfofCYUAAAAADxICS_A0oUPEXRD9fDzlbQoPTcg"-->
                <!--data-callback="YourOnSubmitFn" name="forgot-password" id="forgot-password">-->
                <!--Submeter-->
                <!--</button>-->

                <div class="input-field col s12">
                    <input type="submit" name="forgot-password" id="forgot-password"
                           class="waves-effect waves-light btn green" value="Submeter">
                </div>
            </div>
        </form>
    </div>
</div>