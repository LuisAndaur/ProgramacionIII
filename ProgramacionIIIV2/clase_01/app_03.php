<?php

    $a = 9;
    $b = 6;
    $c = 8;

    if($a==$b || $a==$c || $b==$c){
        echo "No hay valor del medio" . "<br>";
    }
    else{
        if(($a>$b && $b>$c) || ($a<$b && $b<$c)){
            echo "El valor del medio es: ". $b . "<br>";
        }
        else{
            if(($a>$b && $a<$c) || ($a<$b && $a>$c)){
                echo "El valor del medio es: ". $a . "<br>";
            }
            else{
                echo "El valor del medio es: ". $c . "<br>";
            }
        }
    }
?>