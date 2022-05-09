<?php

    require_once 'Pizza.php';
    
    if(isset($_GET['sabor']) && isset($_GET['precio']) && isset($_GET['tipo']) && isset($_GET['cantidad'])){
        $sabor = $_GET['sabor'];
        $precio = floatval($_GET['precio']);
        $tipo = $_GET['tipo'];
        $cantidad = intval($_GET['cantidad']);

        $newId = rand(1, 10001);
        $newPizza = new Pizza($newId, $sabor, $precio, $tipo, $cantidad);        
        
        echo Pizza::CargarPizzas($newPizza,'cargar');
    }
    else{
        echo 'Falta al menos un dato';
    }
?>