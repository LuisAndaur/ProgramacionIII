<?php
    $lapicera = array("color"=>"gris", "marca"=>"Pizzini", "trazo"=>"doble", "precio"=>12);
    echo "Lapicera 1:" . "<br>";
    foreach($lapicera as $k => $valor){
        echo $k . " => " . $valor . "<br>";
    }

    $lapicera = array("color"=>"verde", "marca"=>"Maped", "trazo"=>"grueso", "precio"=>70);
    echo "<br>" . "Lapicera 2:" . "<br>";
    foreach($lapicera as $k => $valor){
        echo $k . " => " . $valor . "<br>";
    }
    
    $lapicera = array("color"=>"azul", "marca"=>"Big", "trazo"=>"fino", "precio"=>27);
    echo "<br>" . "Lapicera 3:" . "<br>";
    foreach($lapicera as $k => $valor){
        echo $k . " => " . $valor . "<br>";
    }
?>