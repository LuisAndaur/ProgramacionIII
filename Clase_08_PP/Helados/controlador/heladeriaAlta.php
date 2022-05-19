<?php

    require_once './modelo/helado.php';

    $carpeta = "ImagenesDeHelados";
    if(!is_dir($carpeta)){
        mkdir($carpeta,0777,true);
        echo "Carpeta ".$carpeta." creada";
    }
    
    if(isset($_POST['sabor']) && isset($_POST['precio']) && isset($_POST['tipo']) && isset($_POST['stock'])){
        $sabor = $_POST['sabor'];
        $precio = floatval($_POST['precio']);
        $tipo = $_POST['tipo'];
        $stock = intval($_POST['stock']);
        $_FILES["archivo"];

        $path = explode(".",$_FILES["archivo"]["name"]);
        $filename = $sabor.$tipo;
        $separador = ".";
        $extension = $path[1];

        $imagen = "";

        $destinoOriginal = $carpeta."/".$filename.$separador.$extension;
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoOriginal);
        $imagen = $filename.$separador.$extension;
        echo "Archivo cargado";
  
        
        $arrayHelado = Helado::LeerHelados();
        if($arrayHelado){
            $contador = count($arrayHelado)-1;
            $newId = $arrayHelado[$contador]->getId() + 1;
        }
        else{
            $newId = 1;
        }
        
        echo Helado::CargarHelados($newId, $sabor, $precio, $tipo, $stock,$imagen);
    }
    else{
        echo 'Falta al menos un dato';
    }
?>