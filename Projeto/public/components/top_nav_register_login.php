<nav class="nav-extended green nav-fixed">
    <div class="nav-wrapper">
        <a href="#">
            <!--<img src="../../images/logo_bioliving.png" alt="logo_bioliving" class="brand-logo logo center">--></a>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <?php /*include_once '../components/top_nav_desktop.php'*/ ?>
    </div>


    <!--Tabs/ SubMenus-->
    <div class="nav-content">
        <ul class="tabs tabs-transparent">
            <li class="tab"><a href="#test1 ">Login</a></li>
            <?php
            // Após uma submissão inválida do registo, e até que seja feito um registo válido, o separador ativo por padrão é o separador de registo.
            if (isset($_SESSION['registo'])) {
                echo "<li class=\"tab\"><a href=\"#test2\" class=\"active\">Registo</a></li>";
            } else {
                echo "<li class=\"tab\"><a href=\"#test2\">Registo</a></li>";
            };
            ?>
        </ul>
    </div>

</nav>
