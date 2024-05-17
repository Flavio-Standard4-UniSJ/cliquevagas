<?php
    include("conecta.php");

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $sql = "UPDATE contatos SET nome= \"$nome\", email=\"$email\", telefone=\"$telefone\" WHERE id=$id";
    $exec = $pdo->query($sql);
   

?>