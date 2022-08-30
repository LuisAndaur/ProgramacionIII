<?php
    require_once("usuario.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $clave = $_POST["clave"];
            $mail = $_POST["mail"];

            echo Usuario::VerificarUsuarioSql($clave,$mail);
            break;
            
        default:
            echo "ERROR: Petición no válida";
            break;
    }
?>