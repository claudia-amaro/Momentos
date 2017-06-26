<?php

if(isset($_GET['id_momento'])){
    $id_momento = $_GET['id_momento'];
}

?>

<div class="row">
    <div class="col s12 margin-top-15">
        <ul class="collection ">


            <?php

            // Ligação à BD 
            require_once('../connections/connection.php');

            $query = "SELECT nome, preco FROM produto WHERE ref_id_tipo_produto=1";
            $result = mysqli_query($link, $query);

            // Mostrar dados
            while ($row_result = mysqli_fetch_assoc($result)){
                $nome_arvore = $row_result["nome"];
                $preco = $row_result["preco"];

                echo "
            <!--Galery of pictures-->
            <li class=\"collection-item avatar\">
                <a href='tree_details.php?nome_arvore=$nome_arvore'><p class='right'><i class=\"material-icons grey-text\">more_vert</i></p></a><img src=\"../../images/store/imagem1.jpg\" alt=\"\" class=\"circle\">
                <span class=\"title\">$nome_arvore</span>
                <p>$preco</p>
                <a href='moments_register.php?nome_arvore=$nome_arvore&preco=$preco'><p class='right'><i class=\"material-icons green-text\">shopping_cart</i></p></a>
            </li>
    ";

            };

//            // Definir a query
//            $query = "SELECT nome_momento, historia, arvore, data_momento  FROM momentos  WHERE id_momento = $id_momento";
//            $result = mysqli_prepare($link, $query);
//
//            // Extrair dados da BD 
//            $result = mysqli_query($link, $query);
//
//            //*Enquanto devolver resultados...
//            while ($row_result = mysqli_fetch_assoc($result)) {
//                //Variáveis
//                $nome_momento = $row_result["nome_momento"];
//                $historia = $row_result["historia"];
//                $arvore = $row_result["arvore"];
//                $data_momento = $row_result["data_momento"];
//
//                echo "
//            <!--Galery of pictures-->
//            <li class=\"collection-item avatar\">
//                <img src=\"../../images/imagem1.png\" alt=\"\" class=\"circle\">
//                <span class=\"title\">Cedro</span>
//                <p>Preço: 5.00€ </p>
//                <a href=\"tree_details.php?id=\" class=\"secondary-content\"><i class=\"material-icons grey-text\">more_vert</i></a>
//            </li>
//    ";
//            }

            ?>
        </ul>
    </div>
</div>
