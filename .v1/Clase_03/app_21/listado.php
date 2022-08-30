<?php

    require("usuario.php");

    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            $request = $_GET["request"];
            if($request === "usuarios"){
                if(!Usuario::LeerCsv()){
                    echo "ERROR: Archivo no encontrado.";
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