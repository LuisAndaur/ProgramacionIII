<?php
    //Recibe todos los valores de un archivo recibido por post
    $_FILES["archivo"];
    $path = explode(".",$_FILES["archivo"]["name"]);
    $filename = $path[0];
    $tipo = ".".$path[1];
    $fecha = "@".date("Y-m-d");
    $carpeta = "prueba";

    $destinoOriginal = $carpeta."/".$filename.$tipo;
    $destinoModificado = $carpeta."/".$filename.$fecha.$tipo;

    if(!is_dir($carpeta)){
        mkdir($carpeta,0777);
        echo "Carpeta creada";
    }

    if(!is_file($destinoOriginal)){
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoOriginal);
        echo "Archivo cargado";
    }
    else{
        echo "El archivo ya existe";
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoModificado);
        echo "El archivo se como: ".$filename.$fecha.$tipo;
    }





    //multiple
    // $_FILES["archivos"];
   
    // var_dump($_FILES["archivos"]);
    //$idUser = 100;
    $fecha = "@".date("Y-m-d");
    // $nombreDeArchivo = explode(".", $_FILES["archivo"]["name"]);
    // var_dump($nombreDeArchivo);
    //$destino = "uploads/".$nombreDeArchivo[0].$idUser.".".$nombreDeArchivo[1];
    // $destino = "uploads/".$nombreDeArchivo[0].$fecha.".".$nombreDeArchivo[1];
    // move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino);

    //obtener nombre modo criollo
    //echo $_FILES["archivos"]["name"][0];

    //recorro los archivos por el nombre y recupero la info
    // foreach($_FILES["archivos"]["name"] as $key=> $valor){
    //     $stringArchivo = explode(".",$valor);
    //     $destino = "uploads/".$stringArchivo[0].$fecha.".".$stringArchivo[1];
    //     move_uploaded_file($_FILES["archivos"]["tmp_name"][$key], $destino);

    // }



?>