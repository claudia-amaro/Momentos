<?php
// Ligação à BD 
require_once('../connections/connection.php');

// Get id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Definir a query
$query = "SELECT id_momento, nome_momento FROM momentos WHERE id_momento = $id";
$result = mysqli_prepare($link, $query);


// Extrair dados da BD 
mysqli_stmt_execute($result);
mysqli_stmt_bind_result($result, $id_produto, $nome_momento);

if (mysqli_stmt_fetch($result)) {

    /*Card for content*/
    echo "
    <nav class=\"nav-extended green nav-fixed\">
        <div class=\"nav-wrapper\">
            <a href=\"#\" class=\" brand-logo center truncate\">$nome_momento</a>
            <a href=\"#\" data-activates=\"slide-out\" class=\"button-collapse\"><i class=\"material-icons\">menu</i></a>
        </div>
    </nav>
            ";
}

// Fechar ligação à BD 
mysqli_stmt_close($result);

?>