<?php
    require("usuario.php");

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $nombre = $_POST["nombre"];
            $clave = $_POST["clave"];
            $mail = $_POST["mail"];
            $usuario = Usuario::AltaUsuario($nombre,$clave,$mail);

            if(!is_null($usuario)){
                if($usuario->GuardarCSV($usuario)){
                    echo "Usuario agregado correctamente.";
                }
                else{
                    echo "ERROR: No se pudo agregar al usuario.";
                }
            }
            else{
                echo "ERROR: Datos de usuario inválido.";
            }
            break;
        
        default:
            echo "ERROR: Petición no válida";
            break;
    }
?>