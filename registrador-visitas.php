<?php 
    $arquivo=fopen("contador.txt", "r");
    $cont=fread($arquivo, 50);
    $cont++;
    $arquivo=fopen("contador.txt", "w");
    fwrite($arquivo, $cont);
    fclose($arquivo); #contador de visitas no site

    $arquivo=fopen("reg-ip.txt", "r");
    $cont=fread($arquivo, 50);
    $ipn=$_SERVER['REMOTE_ADDR'];
    $arquivo=fopen("reg-ip.txt", "a");
    fwrite($arquivo, "{$ipn}\r\n");
    fclose($arquivo); #registra ip dos visitantes do site
?>