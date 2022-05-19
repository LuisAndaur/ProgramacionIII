<?php

    $method = $_SERVER['REQUEST_METHOD'];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    switch ($method) {
        case 'POST':
            switch (key($_POST)) {
                case 'alta':
                    include_once 'controlador/heladeriaAlta.php';
                    break;

                case 'consultar':
                    include_once 'controlador/heladoConsultar.php';
                    break;

                case 'venta':
                    include_once 'controlador/altaVenta.php';
                    break;

                case 'consultasVentas':
                    include_once 'controlador/consultasVentas.php';
                    break;

                case 'devoluciones':
                    include_once 'controlador/devolverHelado.php';
                    break;
                }
            break;

        case 'PUT':
            include_once('controlador/modificarVenta.php');
            break;

        case 'DELETE':
            include_once('controlador/borrarVenta.php');
            break;
        
        default:
            echo "ERROR: Petición no válida";
            break;        
    }
?>