<?php

    require_once './modelo/hamburguesa.php';

    $carpeta = "ImagenesDeHamburguesas";
    if(!is_dir($carpeta)){
        mkdir($carpeta,0777,true);
        echo "Carpeta ".$carpeta." creada";
    }
    
    if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['tipo']) && isset($_POST['cantidad'])){
        $nombre = $_POST['nombre'];
        $precio = floatval($_POST['precio']);
        $tipo = $_POST['tipo'];
        $cantidad = intval($_POST['cantidad']);
        $_FILES["archivo"];

        $path = explode(".",$_FILES["archivo"]["name"]);
        $filename = $nombre.$tipo;
        $separador = ".";
        $extension = $path[1];
        //$fecha = "@".date("Y-m-d");
        $imagen = "";

        $destinoOriginal = $carpeta."/".$filename.$separador.$extension;
        //$destinoModificado = $carpeta."/".$filename.$fecha.$separador.$extension;

        //if(!is_file($destinoOriginal)){
            move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoOriginal);
            $imagen = $filename.$separador.$extension;
            echo "Archivo cargado";
        // }
        // else{
        //     echo "El archivo ya existe";
        //     move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoModificado);
        //     $imagen = $filename.$fecha.$separador.$extension;
        //     echo "El archivo se como: ".$filename.$fecha.$separador.$extension;
        // }
        
        $arrayHamburguesa = Hamburguesa::LeerHamburguesas();
        if($arrayHamburguesa){
            $contador = count($arrayHamburguesa)-1;
            $newId = $arrayHamburguesa[$contador]->getId() + 1;
        }
        else{
            $newId = 1;
        }
        
        echo Hamburguesa::Cargarhamburguesas($newId, $nombre, $precio, $tipo, $cantidad,$imagen);
    }
    else{
        echo 'Falta al menos un dato';
    }
?>