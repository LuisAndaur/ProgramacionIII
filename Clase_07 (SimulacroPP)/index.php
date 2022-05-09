<?php

    $method = $_SERVER['REQUEST_METHOD'];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    switch ($method) {
        case 'GET':
            switch (key($_GET)) {
                case 'cargar':
                    include_once 'Parte1/PizzaCarga.php';
                    //var_dump(key($_GET));
                    break;
                }
            break;

        case 'POST':
            switch (key($_POST)) {
                case 'consultas':
                    include_once 'Parte1/PizzaConsultar.php';
                    //var_dump(key($_GET));
                    break;
                }
            break;
        
        default:
            echo "ERROR: Petición no válida";
            break;        
    }
?>