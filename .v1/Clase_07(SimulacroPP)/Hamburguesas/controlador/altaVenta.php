<?php
    require_once './modelo/hamburguesa.php';
    require_once './modelo/venta.php';

    $carpeta = "ImagenesDeLaVenta";
    if(!is_dir($carpeta)){
        mkdir($carpeta,0777,true);
        echo "Carpeta ".$carpeta." creada";
    }

    if(isset($_POST['mail']) && isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['cantidad'])){
        $mail = $_POST['mail'];
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $cantidad = (int)$_POST['cantidad'];

        $user = explode("@",$mail);
        $path = explode(".",$_FILES["archivo"]["name"]);
        $fecha = date("Y-m-d");
        $filename = $nombre.$tipo.$user[0].$fecha;
        $separador = ".";
        $extension = $path[1];
        $imagen = "";

        $destinoOriginal = $carpeta."/".$filename.$separador.$extension;
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoOriginal);
        $imagen = $filename.$separador.$extension;

        if(Venta::AltaVenta($mail,$nombre,$tipo,$cantidad,$imagen)>0){
            echo 'Venta exitosa'.PHP_EOL;
        }
    }



?>