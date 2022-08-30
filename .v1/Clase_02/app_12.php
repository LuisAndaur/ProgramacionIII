<?php
    $caracter = array('a','l','f','a','j','o','r');

    function InvertirOrden($vec){
        return array_reverse($vec);
    }

    $caracter = InvertirOrden($caracter);

    foreach($caracter as $valor){
        echo $valor;
    }
?>