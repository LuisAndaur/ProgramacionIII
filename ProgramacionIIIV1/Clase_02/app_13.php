<?php
    function ValidarCaracteres($palabra, $max){
        if(strlen($palabra)<=$max && (strtolower($palabra)=='recuperatorio' || strtolower($palabra)=='parcial' || strtolower($palabra)=='programacion') ){
            return 1;
        }
        return 0;
    }

    echo "Pertenece 1(si) - 0(no): " . ValidarCaracteres('Caballo',13) . "<br>";
    echo "Pertenece 1(si) - 0(no): " . ValidarCaracteres('Recuperatorio',13) . "<br>";
    echo "Pertenece 1(si) - 0(no): " . ValidarCaracteres('agua',3) . "<br>";

?>