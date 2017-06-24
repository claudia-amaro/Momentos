<!DOCTYPE html>
<html lang="pt">
<head>
    <!--Import Google Icon Font-->
    <?php include_once "../helpers/fonts.php" ?>
    <!--Import materialize.css-->
    <?php include_once "../helpers/css.php" ?>

    <!--Let browser know website is optimized for mobile-->
    <?php include_once "../helpers/meta.php" ?>
    <title>Projeto BioLiving - Página Modelo</title>
</head>

<body>

<!--Page Content-->
<div class="row">

    <!--Galery of pictures-->
    <div class="carousel carousel-slider center col s12" data-indicators="true">
        <div class="carousel-fixed-item center">
            <a class="btn waves-effect white grey-text darken-text-2" href="moments.php">Skip</a>
            <a class="btn waves-effect white grey-text darken-text-2" href="moments.php">Skip</a>
        </div>
        <div class="carousel-item white-text"
             style="background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center; height: 100vh">
            <h2>Fauna</h2>
            <p class="white-text">Para nós é importante cuidar e desenvolver habitats.</p>
        </div>
        <div class="carousel-item  white-text" style="background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center; height: 100vh">
            <h2>Flora</h2>
            <p class="white-text">Por cada árvore retirada iremos plantar 6 no seu lugar.</p>
        </div>
        <div class="carousel-item  white-text" style="background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center; height: 100vh" >
            <h2>Educação</h2>
            <p class="white-text">A educação é para todos e por isso a Bioliving já distribuiu 3 bolsas de estudo.</p>
        </div>
        <div class="carousel-item  white-text" style="background-image: url('../../images/imagem1.png'); background-size: cover; background-position: center; height: 100vh">
            <h2>Momentos</h2>
            <p class="white-text">Regista e partilha os momentos especiais com o apadrinhamento de uma árvore.</p>
        </div>
    </div>
</div>

    <!--Import jQuery before materialize.js-->
    <?php include_once "../helpers/jquery_js.php" ?>

</body>
</html>

