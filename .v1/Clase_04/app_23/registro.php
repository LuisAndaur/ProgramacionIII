<?php
    require_once("usuario.php");
    require_once("../../Tools/json.php");

    $carpeta = "Usuario/Fotos";
    if(!is_dir($carpeta)){
        mkdir($carpeta,0777,true);
        echo "Carpeta ".$carpeta." creada";
    }

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $nombre = $_POST["nombre"];
            $clave = $_POST["clave"];
            $mail = $_POST["mail"];

            $_FILES["archivo"];
            $path = explode(".",$_FILES["archivo"]["name"]);
            $filename = $path[0];
            $separador = ".";
            $tipo = $path[1];
            $fecha = "@".date("Y-m-d");

            $destinoOriginal = $carpeta."/".$filename.$separador.$tipo;
            $destinoModificado = $carpeta."/".$filename.$fecha.$separador.$tipo;

            if(!is_file($destinoOriginal)){
                move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoOriginal);
                echo "Archivo cargado";
            }
            else{
                echo "El archivo ya existe";
                move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoModificado);
                echo "El archivo se como: ".$filename.$fecha.$tipo;
            }

            $fechaRegistro = new DateTime("now");
            $newId = rand(1,10001);
            $usuario = Usuario::AltaUsuario($newId,$nombre, $clave, $mail, $fechaRegistro->format('d-m-Y H:m:s'),$destinoOriginal);


            $usuarios = Json::LeerJson("Usuarios.json");
            array_push($usuarios,$usuario);

            if(Json::GuardarJSON($usuarios,"Usuarios.json"))
            {
                echo "Usuario agregado con éxito";
            }
            break;
        
        default:
            echo "ERROR: Petición no válida";
            break;
    }
?>