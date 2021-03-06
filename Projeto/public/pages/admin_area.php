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

    <!--Let browser know website is optimized for mobile-->
    <?php include_once "../helpers/meta.php" ?>
    <title>Área de Administrador</title>
</head>

<body>

<div class="content">
    <div id="conteudo_mobile" class="hide-on-large-only">
        <!--Side Navigation = Menu on Mobile -->
        <?php include_once "../components/side_nav.php" ?>
        <?php include "../components/no_access_desktop.php" ?>
    </div>

    <div id="conteudo_pc" class="hide-on-med-and-down">
        <!--Top Navigation-->
        <?php include_once "../components/top_nav_info_admin_area.php" ?>
        <!--Page Content-->
        <?php include_once "../components/admin_area.php" ?>
    </div>
</div>

<!--Footer-->
<?php include_once "../components/footer.php" ?>

<!--Import jQuery before materialize.js-->
<?php include_once "../helpers/jquery_js.php" ?>

</body>
</html>