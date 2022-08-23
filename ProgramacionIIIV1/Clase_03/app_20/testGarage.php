<?php
    require "garage.php";

    $auto1 = new Auto("Rojo","Fiat");
    $auto2 = new Auto("Negro","Fiat");

    $auto3 = new Auto("Blanco","Ford", 1000);
    // $auto4 = new Auto("Blanco","Ford", 2000);

    // $auto5 = new Auto("Gris","Renault", 500, null);

    $garage = new Garage("Socialito", 100.9, array($auto1,$auto2, $auto3));

    // $garage->MostrarGarage();

    // echo "EQUALS" . "<br>";
    // echo "Está el auto?: " . $garage->Equals($auto2) . "<br>";
    // echo "<br>";
    // echo "ADD" . "<br>";
    // echo "Agregar auto: " . $garage->Add($auto5) . "<br>";
    // echo "<br>";
    // $garage->MostrarGarage();

    // echo "<br>";
    // echo "REMOVE" . "<br>";
    // echo "Eliminar auto: " . $garage->Remove($auto5) . "<br>";

    // echo "<br>";

    // $garage->MostrarGarage();

    // echo "<br>";
    // echo "<br>";
    echo "<br>";
    echo "ARCHIVOS GARAGE:" . "<br>";
    Garage::AltaGarage($garage);

    $archivo = "garages.csv";
    Garage::LeerListado($archivo);


?>