<?php
    require_once("usuario.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            $request = $_GET["request"];
            if($request === "usuarios"){                
                if(!Usuario::ListaUsuarios()){
                    echo "ERROR: No existen usuarios.";
                }
            }
            else{
                echo "ERROR: Petición no encontrada.";
            }
            break;

        default:
            echo "ERROR: Petición no válida";
            break;
    }
?>