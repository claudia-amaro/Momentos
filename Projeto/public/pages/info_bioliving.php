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
    <title>Projeto BioLiving - O Projeto</title>
</head>

<body>

<div id="conteudo_mobile" class="hide-on-large-only">

    <!--Side Navigation = Menu on Mobile -->
    <?php include_once "../components/side_nav.php" ?>

    <!--Top Navigation-->
    <?php include_once "../components/top_nav_info_bioliving.php" ?>

    <!--Page Content-->
    <div id="bioliving1" class="col s12">
        <?php include_once "../components/bioliving_contacts.php" ?>
    </div>
    <div id="bioliving2" class="col s12">
        <?php include_once "../components/info_bioliving.php" ?>
    </div>

</div>

<div id="conteudo_pc" class="hide-on-med-and-down">
    <?php include "../components/no_access.php" ?>
</div>

<!--Footer-->
<?php include_once "../components/footer.php" ?>

<!--Import jQuery before materialize.js-->
<?php include_once "../helpers/jquery_js.php" ?>

</body>
</html>