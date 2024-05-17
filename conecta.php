<?php
    $pdo = new PDO("mysql:host=localhost; dbname=agenda822","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>