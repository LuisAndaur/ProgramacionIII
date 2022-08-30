<?php
    require("usuario.php");

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $nombre = "user";
            $clave = $_POST["clave"];
            $mail = $_POST["mail"];
            $usuario = Usuario::AltaUsuario($nombre,$clave,$mail);

            if(!is_null($usuario)){
                echo $usuario->VerificarUsuario($usuario);
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