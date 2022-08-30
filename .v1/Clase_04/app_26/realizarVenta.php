<?php
    require_once("venta.php");
    require_once("producto.php");
    require_once("usuario.php");
    require_once("../../Tools/json.php");

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $respuesta = "";
            $codProducto = $_POST["codProducto"];
            $idUsuario = $_POST["idUsuario"];
            $cantidad = $_POST["cantidad"];

            settype($idUsuario, "integer");
            settype($cantidad, "integer");
            $newId = rand(1,10001);

            if(Producto::ExisteProducto($codProducto) && Usuario::ExisteUsuario($idUsuario)){
                if(Producto::HayStock($codProducto,$cantidad)){
                    $respuesta = "Venta Realizada";
                    Producto::descontarStock($codProducto,$cantidad);
                    $ventas = Json::LeerJson("Ventas.json");
                    $venta = new Venta($newId,$codProducto,$idUsuario,$cantidad);
                    array_push($ventas,$venta);
                    Json::GuardarJson($ventas,"Ventas.json");
                }
                else{
                    $respuesta = "No hay stock suficiente";
                }
            }
            else{
                $respuesta = "No se pudo hacer";
            }

            echo $respuesta;
            break;
        
        default:
            echo "ERROR: Petición no válida".PHP_EOL;
            break;
    }
?>