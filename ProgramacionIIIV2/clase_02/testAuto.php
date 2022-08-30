<?php
require_once("app_17.php");

    $auto1 = new Auto('fiat', 'blanco');
    $auto2 = new Auto('fiat', 'rojo');

    $auto3 = new Auto('bmw', 'gris',135000.45);
    $auto4 = new Auto('bmw', 'gris',160000.78);

    $auto5 = new Auto('volvo', 'negro',140000.90, date_create("d.m.Y"));

    echo "AGREGAR IMPUESTOS" . PHP_EOL;
    echo "AUTO3 Precio + imp: " . $auto3->agregarImpuestos(1500) . PHP_EOL;
    echo "AUTO4 Precio + imp: " . $auto4->agregarImpuestos(1500) . PHP_EOL;
    echo "AUTO5 Precio + imp: " . $auto5->agregarImpuestos(1500) . PHP_EOL;

    echo "" . PHP_EOL;

    echo "ADD" . PHP_EOL;
    echo "AUTO1 + AUTO2: " . Auto::add($auto1,$auto2) . PHP_EOL;

    echo "" . PHP_EOL;

    echo "EQUALS" . PHP_EOL;
    echo "AUTO1 = AUTO2: " . $auto1->equals($auto2) . PHP_EOL;
    echo "AUTO1 = AUTO5: " . $auto1->equals($auto5) . PHP_EOL;

    echo "" . PHP_EOL;

    echo "AUTOS IMPARES" . PHP_EOL;
    echo "AUTO1:" . PHP_EOL;
    echo Auto::mostrarAuto($auto1) . PHP_EOL;
    echo "AUTO3:" . PHP_EOL;
    echo Auto::mostrarAuto($auto3) . PHP_EOL;
    echo "AUTO5:" . PHP_EOL;
    echo Auto::mostrarAuto($auto5) . PHP_EOL;
?>