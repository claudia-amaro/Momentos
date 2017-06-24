<!--FORMULÁRIO PARA REDEFINIR A PASSWORD-->

<div id="login" class="row">
        <form class="col s12" action="../components/new_password_recover_control.php" method="post" name="frmRecover" id="frmRecover">
<!--              onSubmit="return validate_forgot();">-->
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate" name="password">
                    <label for="password">Password</label>
                    <span class="green-text"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password_confirmation" type="password" class="validate" name="cpassword">
                    <label for="password">Confirmação da Password</label>
                    <span class="green-text"></span>
                </div>
            </div>

            <p class="green-text" id="msg_envio">
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                    echo "Verifica o teu email.";
                }
                ?>
            </p>
            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" name="recover_form_submit" id="register_form_submit" class="waves-effect
                    waves-light btn green" value="Submeter">
                </div>
            </div>
        </form>
    </div>
</div>