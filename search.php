
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>CRUD PDO</title>
</head>

<body>

<?php

    include("conecta.php");
    if(isset($_POST["pesquisar"])){

    $buscar = $_POST["pesquisar"];

    $sql = "SELECT * FROM contatos WHERE nome like '%".$buscar."%'";
    $exec = $pdo->query($sql);

    while($registro = $exec->fetch()){
        echo "<div class='alert alert-light' id='resultado' role='alert'>".$registro["id"]." - ".$registro["nome"]." - ".$registro["email"]." - ".$registro["telefone"]."  ";
        echo "  [<a href='formUpdate.php?id=".$registro["id"]."'>atualizar</a>]";
        echo "  [<a href='delete.php?id=".$registro["id"]."'>excluir</a>]</div>";
    }
    } else {
        echo "<div class='alert alert-light' role='alert'>Nenhum registro encontrado</div>";
    }
?>
</body>

</html>