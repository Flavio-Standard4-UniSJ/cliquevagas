<?php
    include("conecta.php");

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO contatos (`nome`,`email`, `telefone`) VALUES (\"$nome\",\"$email\",\"$telefone\")";
    $exec = $pdo->query($sql);
   

?>