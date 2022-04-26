<?php

    require_once("usuario.php");
    require_once("../../Tools/json.php");

    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            $request = $_GET["request"];
            if($request === "usuarios"){
                $arrUsuarios = Json::LeerJson("Usuarios.json");
                if(count($arrUsuarios)>0){
                    Usuario::ListaUsuarios($arrUsuarios);
                }
                else{
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