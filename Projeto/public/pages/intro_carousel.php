<!DOCTYPE html>
<html lang="pt">
<head>
    <!--Import Google Icon Font-->
    <?php include_once "../helpers/fonts.php" ?>
    <!--Import materialize.css-->
    <?php include_once "../helpers/css.php" ?>

    <!--Let browser know website is optimized for mobile-->
    <?php include_once "../helpers/meta.php" ?>
    <title>Momentos</title>
</head>

<body>

<!--Page Content-->
<div class="row">

    <!--Galery of pictures-->
    <div class="carousel carousel-slider center col s12" data-indicators="true">
        <div class="carousel-fixed-item center">
            <a class="btn waves-effect white grey-text darken-text-2" href="moments.php">Saltar</a>
        </div>
        <div class="carousel-item white-text"
             style="background-image: url('../../images/bioliving/imagem11.jpg'); background-size: cover; background-position: center; height: 100vh">
            <div class="gradient-photo">
                <h2>Fauna</h2>
                <p class="white-text margin-text">Para nós é importante cuidar e desenvolver habitats.</p>
            </div>
        </div>
        <div class="carousel-item  white-text"
             style="background-image: url('../../images/bioliving/imagem14.jpg'); background-size: cover; background-position: 70%; height: 100vh">
            <div class="gradient-photo">
                <h2>Flora</h2>
                <p class="white-text margin-text">Por cada árvore retirada iremos plantar 6 no seu lugar.</p>
            </div>
        </div>
        <div class="carousel-item  white-text"
             style="background-image: url('../../images/bioliving/imagem17.jpg'); background-size: cover; background-position: center; height: 100vh">
            <div class="gradient-photo">
                <h2>Educação</h2>
                <p class="white-text margin-text">A educação é para todos e por isso a Bioliving já distribuiu 3 bolsas
                    de estudo.</p>
            </div>
        </div>
        <div class="carousel-item  white-text"
             style="background-image: url('../../images/bioliving/imagem3.jpg'); background-size: cover; background-position: 40%; height: 100vh">
            <div class="gradient-photo">
                <h2>Momentos</h2>
                <p class="white-text margin-text">Regista e partilha os momentos especiais com o apadrinhamento de uma
                    árvore.</p>
            </div>
        </div>
    </div>
</div>

<!--Import jQuery before materialize.js-->
<?php include_once "../helpers/jquery_js.php" ?>

</body>
</html>

