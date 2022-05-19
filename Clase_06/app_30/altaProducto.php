<?php
    require_once("producto.php");
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
            $fechaRegistro = new DateTime("now");

            $respuesta = Producto::AltaProducto($codigo, $nombre, $tipo, $stock, $precio,$fechaRegistro->format('d-m-Y'));
            if ($respuesta) {
                echo "Usuario agregado con exito";
            }
            else {
                echo "ERROR: No se pudo ingresar el usuario";
            }
            break;
        
        default:
            echo "ERROR: Petición no válida".PHP_EOL;
            break;
    }
?>