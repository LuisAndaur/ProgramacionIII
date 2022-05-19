<?php

    require_once './modelo/hamburguesa.php';
    require_once './modelo/venta.php';

    if(isset($_POST['consulta'])){
        $consulta = $_POST['consulta'];    

        switch ($consulta) {
            case 'consultaFecha':
                if(isset($_POST['fecha'])){
                    $fecha = $_POST['fecha'];
                    Venta::VentaParticular($fecha);
                }
                else{
                    echo 'Error parametro'.PHP_EOL;
                }
                break;
    
            case 'consultaFechas':
                if(isset($_POST['fecha1']) && isset($_POST['fecha2'])){
                    $fecha1 = $_POST['fecha1'];
                    $fecha2 = $_POST['fecha2'];
                    Venta::VentaEntreFechas($fecha1,$fecha2);
                }
                else{
                    echo 'Error parametro'.PHP_EOL;
                }                
                break;
    
            case 'consultaUser':
                if(isset($_POST['usuario'])){
                    $user = $_POST['usuario'];
                    Venta::VentaDeUsuario($user);
                }
                else{
                    echo 'Error parametro'.PHP_EOL;
                }
                break;
    
            case 'consultaTipo':
                if(isset($_POST['tipo'])){
                    $tipo = $_POST['tipo'];
                    Venta::VentaDeTipo($tipo);
                }
                else{
                    echo 'Error parametro'.PHP_EOL;
                }
                break;
        
            default:
                echo 'La consulta no existe'.PHP_EOL;
                break;
        }
    }
    
?>