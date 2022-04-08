<?php
    $impares = array();
    for($i=0; $i<20; $i++){
        if($i%2 != 0){
            array_push($impares,$i);
        }
    }

    // var_dump($impares);
    echo "Estructura FOR:" . "<br>";
    for($i=0; $i<10; $i++){
        echo $impares[$i] . "<br>";
    }

    echo "Estructura WHILE:" . "<br>";
    $posicion = 0;
    while($posicion != 10){
        echo $impares[$posicion] . "<br>";
        $posicion++;
    }

    echo "Estructura FOREACH:" . "<br>";
    foreach($impares as $impar){
        echo $impar . "<br>";
    }
?>