<?php
    require_once("producto.php");
    require_once("../../Tools/json.php");

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $codigo = $_POST["codigo"];
            $nombre = $_POST["nombre"];
            $tipo = $_POST["tipo"];
            $stock = $_POST["stock"];
            $precio = $_POST["precio"];

            settype($stock, "integer");
            settype($precio, "double");
            $newId = rand(1,10001);

            $producto = Producto::AltaProducto($newId,$nombre, $codigo, $tipo, $stock, $precio);

            $respuesta = Producto::VerificarProducto($producto);
            echo $respuesta;
            break;
        
        default:
            echo "ERROR: Petición no válida".PHP_EOL;
            break;
    }
?>