<?php
    $lapicera1 = array("color"=>"rojo", "marca"=>"big", "trazo"=>"fino", "precio"=>10);    
    $lapicera2 = array("color"=>"azul", "marca"=>"ph", "trazo"=>"fino", "precio"=>15);    
    $lapicera3 = array("color"=>"negro", "marca"=>"roller", "trazo"=>"variable", "precio"=>8);
    $lapiceras = array($lapicera1,$lapicera2,$lapicera3);

    echo "Lapiceras:" . "<br>";
    foreach($lapiceras as $k => $valor){
        echo "<br>" . "Lapicera " . $k+1 . ": " . "<br>";
        foreach($valor as $k => $valor2){
            echo $k . " => " . $valor2 . "<br>";
        }
    }
?>