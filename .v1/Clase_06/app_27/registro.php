<?php
    require_once("usuario.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $clave = $_POST["clave"];
            $mail = $_POST["mail"];
            $localidad = $_POST["localidad"];
            $fechaRegistro = new DateTime("now");

            $respuesta = Usuario::AltaUsuario($nombre,$apellido, $clave, $mail, $fechaRegistro->format('d-m-Y'),$localidad);
            if ($respuesta) {
                echo "Usuario agregado con exito";
            }
            else {
                echo "ERROR: No se pudo ingresar el usuario";
            }
            break;

        default:
            echo "ERROR: Petición no válida";
            break;
    }
?>