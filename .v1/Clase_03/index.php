<?php
    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            echo "Peticion por GET";
            echo json_encode(["parametros: " => $_GET]);
            break;

        case "POST":
            //$nombre = $_POST["nombre"];
            //echo json_encode(array("mensaje" => $nombre));
            echo json_encode(array("mensaje" => $_POST));
            break;
        
        default:
            echo "Peticion no válida";
            break;
    }


?>