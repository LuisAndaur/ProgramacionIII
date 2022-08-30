<?php
    date_default_timezone_set('America/Buenos_Aires');

    echo date("F j, Y, g:i a")."<br>";
    echo date("m.d.y"). "<br>";
    echo date("j, n, Y"). "<br>";

    $dia = date("d");
    $mes = date("m");

    echo $dia ."<br>". $mes. "<br>";

    if($mes == 1 || $mes == 2 || ($mes == 12 && $dia > 20) || ($mes == 3 && $dia < 21) ){
        echo "Estamos en Verano" . "<br>";
    }
    else{
        if($mes == 4 || $mes == 5 || ($mes == 3 && $dia > 20 ) ||( $mes == 6 && $dia < 21) ){
            echo "Estamos en Otoño" . "<br>";
        }
        else{
            if($mes == 7 || $mes == 8 || ($mes == 6 && $dia > 20) || ($mes == 9 && $dia < 21) ){
                echo "Estamos en Invierno" . "<br>";
            }
            else{
                echo "Estamos en Primavera" . "<br>";
            }
        }
    }
?>