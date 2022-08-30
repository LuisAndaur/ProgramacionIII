<?php
    require_once './modelo/helado.php';
    require_once './modelo/venta.php';

    $carpeta = "ImagenesDeLaVenta";
    if(!is_dir($carpeta)){
        mkdir($carpeta,0777,true);
        echo "Carpeta ".$carpeta." creada";
    }

    if(isset($_POST['mail']) && isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_POST['stock'])){
        $mail = $_POST['mail'];
        $sabor = $_POST['sabor'];
        $tipo = $_POST['tipo'];
        $stock = (int)$_POST['stock'];

        $user = explode("@",$mail);
        $path = explode(".",$_FILES["archivo"]["name"]);
        $fecha = date("Y-m-d");
        $filename = $sabor.$tipo.$user[0].$fecha;
        $separador = ".";
        $extension = $path[1];
        $imagen = "";

        $destinoOriginal = $carpeta."/".$filename.$separador.$extension;
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoOriginal);
        $imagen = $filename.$separador.$extension;

        if(Venta::AltaVenta($mail,$sabor,$tipo,$stock,$imagen)>0){
            echo 'Venta exitosa'.PHP_EOL;
        }
    }



?>