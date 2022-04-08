<?php
    date_default_timezone_set("America/Buenos_Aires");
    echo date("F j, Y, g:i a"). "<br>";
    echo date("y/m/d"). "<br>";
    echo date("d.m.y"). "<br>";

    $dia = date("d");
    $mes = date("m");

    switch($mes)
    {
            case 12:
                if($dia<21){
                $estacion = "Primavera";
                }
                else{
                    $estacion = "Verano";
                }
            break;

            case 1:
            case 2:
                $estacion = "Verano";
            break;
    
            case 3:
                if($dia<21){
                    $estacion = "Verano";
                }
                else{
                    $estacion = "Otoño";
                }
            break;

            case 4:
            case 5:
                $estacion = "Otoño";
            break;
    
            case 6:
                if($dia<21){
                    $estacion = "Otoño";
                }
                else{
                    $estacion = "Invierno";
                }
            break;

            case 7:
            case 8:
                $estacion = "Invierno";
            break;
            
            case 9:
                if($dia<21){
                    $estacion = "Invierno";
                }
                else{
                    $estacion = "Primavera";
                }
            break;

            default:
                $estacion = "Primavera";
            break;
    }

    echo $estacion;

?>