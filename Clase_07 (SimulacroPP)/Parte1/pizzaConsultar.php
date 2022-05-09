<?php

    require_once 'Pizza.php';

    if(isset($_POST['sabor']) && isset($_POST['tipo'])){
        $sabor = $_POST['sabor'];
        $tipo = $_POST['tipo'];


        echo 'Pizza a consultar:'.PHP_EOL;
        echo 'Sabor: '.$sabor.' Tipo: '.$tipo.PHP_EOL;

        echo Pizza::Buscador($sabor, $tipo).PHP_EOL;
    }
?>