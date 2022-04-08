<?php
    $lapicera = array("color"=>"rojo", "marca"=>"big", "trazo"=>"fino", "precio"=>10);
    echo "Lapicera 1:" . "<br>";
    foreach($lapicera as $k => $valor){
        echo $k . " => " . $valor . "<br>";
    }

    $lapicera = array("color"=>"azul", "marca"=>"ph", "trazo"=>"fino", "precio"=>15);
    echo "<br>" . "Lapicera 2:" . "<br>";
    foreach($lapicera as $k => $valor){
        echo $k . " => " . $valor . "<br>";
    }
    
    $lapicera = array("color"=>"negro", "marca"=>"roller", "trazo"=>"variable", "precio"=>8);
    echo "<br>" . "Lapicera 3:" . "<br>";
    foreach($lapicera as $k => $valor){
        echo $k . " => " . $valor . "<br>";
    }
?>