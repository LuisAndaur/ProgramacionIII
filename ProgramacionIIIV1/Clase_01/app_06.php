<?php
    $acumulador = 0;
    $vector = [rand(0,10),rand(0,10),rand(0,10),rand(0,10),rand(0,10)];

    //var_dump($vector);
    foreach($vector as $valor)
    {
        $acumulador += $valor;
    }

    $promedio = $acumulador/5;

    if($promedio>6)
    {
        echo "El promedio es mayor a 6";
    }
    else
    {
        if($promedio<6)
        {
            echo "El promedio es menor a 6";
        }
        else
        {
            echo "El promedio es igual a 6";
        }
    }
?>