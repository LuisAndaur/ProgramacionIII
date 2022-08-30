<?php
require_once("garage.php");

    $auto1 = new Auto("Rojo","Fiat");
    $auto2 = new Auto("Negro","Fiat");
    $auto3 = new Auto("Blanco","Ford", 1000);
    $auto4 = new Auto("Blanco","Ford", 2000);
    $auto5 = new Auto("Gris","Renault", 500, date_create("d.m.Y"));

    $garage = new Garage("Socialito", 100.9, array($auto1,$auto2,$auto4));

    $garage->MostrarGarage();
    echo "" . PHP_EOL;

    echo "EQUALS" . PHP_EOL;
    echo "Esta AUTO1: " . $garage->equals($auto2) . PHP_EOL;
    echo "Esta AUTO5: " . $garage->equals($auto5) . PHP_EOL;

    echo "" . PHP_EOL;

    echo "ADD" . PHP_EOL;
    echo "Agregar AUTO3: " . $garage->add($auto3) . PHP_EOL;
    echo "Agregar AUTO2: " . $garage->add($auto2) . PHP_EOL;

    echo "" . PHP_EOL;

    echo "REMOVE" . PHP_EOL;
    echo "Eliminar AUTO5: " . $garage->remove($auto5) . PHP_EOL;
    echo "Eliminar AUTO4: " . $garage->remove($auto4) . PHP_EOL;

    echo "" . PHP_EOL;
    $garage->MostrarGarage();
    echo "" . PHP_EOL;

?>