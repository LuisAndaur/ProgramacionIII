<?php
    $vec = array(1=>90, 30=>7, "e"=>99, "hola"=>"mundo");

    // var_dump($vec);
    foreach($vec as $k => $valor){
        echo "La clave: " . $k . " => Valor: " . $valor . "<br>";
    }
?>