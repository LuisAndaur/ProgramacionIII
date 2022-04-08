<?php
    $contador = 1;
    $resultado = 0;

    while($resultado + $contador<=1000)
    {
        echo $resultado . "+" . $contador . "=";
        $resultado += $contador;
        $contador++;
        echo $resultado . "<br>";
    }

    echo "El resultado es" . $resultado . " se sumaron: " . $contador . "números";
?>