<?php
    require "auto.php";

    $auto1 = new Auto("Rojo","Fiat");
    $auto2 = new Auto("Negro","Fiat");

    $auto3 = new Auto("Blanco","Ford", 1000);
    $auto4 = new Auto("Blanco","Ford", 2000);

    $auto5 = new Auto("Gris","Renault", 500, null);

    //IMPRESION
    echo "Agregar Impuestos" . "<br>";
    echo "Auto3: " . $auto3->AgregarImpuestos(1500) . "<br>";
    echo "Auto4: " . $auto4->AgregarImpuestos(1500) . "<br>";
    echo "Auto5: " . $auto5->AgregarImpuestos(1500) . "<br>";
    echo "<br>";
    echo "Importe sumado" . "<br>";
    $importeDouble = Auto::Add($auto1, $auto2);
    echo "Auto1 + Auto2 = " . $importeDouble . "<br>";
    echo "<br>";
    echo "Equals" . "<br>";
    echo "Auto1 = Auto2: " . $auto1->Equals($auto2) . "<br>";
    echo "Auto1 = Auto5: " . $auto1->Equals($auto5) . "<br>";
    echo "<br>" . "<br>";
    echo "Mostrar autos impares" . "<br>";
    echo "<br>";
    echo "Auto1" . "<br>";
    Auto::MostrarAuto($auto1) . "<br>";
    echo "<br>";
    echo "Auto3" . "<br>";
    Auto::MostrarAuto($auto3) . "<br>";
    echo "<br>";
    echo "Auto5" . "<br>";
    Auto::MostrarAuto($auto5) . "<br>";

    echo "<br>";
    echo "<br>";
    echo "<br>";

    $archivo = "autos.csv";

    Auto::AltaAuto(new Auto("Fiat", "Rojo", 1500));
    Auto::AltaAuto(new Auto("Ford", "Blanco", 5500));
    Auto::AltaAuto(new Auto("Chevy", "Azul", 12500));

    echo "Listado de autos: " . "<br>";
    Auto::LeerListado($archivo);


?>