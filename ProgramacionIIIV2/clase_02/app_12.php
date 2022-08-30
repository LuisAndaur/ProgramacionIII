<?php
    $caracteres = array('H','O','L','A');

    function invertirOrden($vec){
        return array_reverse($vec);
    }

    $vecReverse = invertirOrden($caracteres);
    foreach($vecReverse as $valor){
        echo $valor;
    }
?>