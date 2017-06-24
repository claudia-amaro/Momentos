<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <!--Import Google Icon Font-->
    <?php include_once "../helpers/fonts.php" ?>
    <!--Import materialize.css-->
    <?php include_once "../helpers/css.php" ?>
    <!--Import map.css-->
    <?php include_once "../helpers/map.php" ?>

    <!--Let browser know website is optimized for mobile-->
    <?php include_once "../helpers/meta.php" ?>

    <title>Projeto BioLiving - Procurar Momentos</title>
</head>

<body>
<div class="content">
    <div id="conteudo_mobile" class="hide-on-large-only">

        <!--Side Navigation = Menu on Mobile -->
        <?php include_once "../components/side_nav.php" ?>

        <!--Top Navigation-->
        <?php include_once "../components/top_nav_moments_search.php" ?>

        <!--Content (Mapa)-->

        <?php include_once "../components/map_register.php" ?>
    </div>
    <div id="conteudo_pc" class="hide-on-med-and-down">
        <?php include "../components/no_access.php" ?>
    </div>
</div>

<!--Footer-->
<?php include_once "../components/footer.php" ?>

<!--Import jQuery before materialize.js-->
<?php include_once "../helpers/jquery_js.php" ?>

</body>
</html>