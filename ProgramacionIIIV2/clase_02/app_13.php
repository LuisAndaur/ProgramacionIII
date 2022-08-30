<?php
    function validacion($palabra, $max){
        $ok = 0;
        if(strlen($palabra)<=$max && (strtolower($palabra)=='recuperatorio' || strtolower($palabra)=='parcial' || strtolower($palabra)=='programacion')){
            $ok = 1;
        }
        return $ok;
    }

    echo "Palabra1: " . validacion('tortuga',7) . PHP_EOL;
    echo "Palabra2: " . validacion('parcial',7) . PHP_EOL;
    echo "Palabra3: " . validacion('programacion',12) . PHP_EOL;
    echo "Palabra4: " . validacion('figuritas',3) . PHP_EOL;
?>