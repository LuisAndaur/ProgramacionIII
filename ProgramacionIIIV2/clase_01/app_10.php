<?php
    $lapicera1 = array("color"=>"gris", "marca"=>"Pizzini", "trazo"=>"doble", "precio"=>12);    
    $lapicera2 = array("color"=>"verde", "marca"=>"Maped", "trazo"=>"grueso", "precio"=>70);    
    $lapicera3 = array("color"=>"azul", "marca"=>"Big", "trazo"=>"fino", "precio"=>27);
    $lapiceras = array($lapicera1,$lapicera2,$lapicera3);

    echo "Lapiceras:" . "<br>";
    foreach($lapiceras as $k => $valor){
        echo "<br>" . "Lapicera " . $k+1 . ": " . "<br>";
        foreach($valor as $k => $valor2){
            echo $k . " => " . $valor2 . "<br>";
        }
    }
?>