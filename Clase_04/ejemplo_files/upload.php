<?php
    //----- VALIDAR SUBDIRECTORIO -------------
    if(!is_dir('uploads')){
		mkdir('uploads', 0777);
	}

    $destino = "uploads/".$_FILES["archivo"]["name"];

    //----- VALIDAR SUBDIRECTORIO Y ARCHIVO -------------
    if(!is_file($destino)){
		move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
	}

    //----- DIRECTORIO TEMPORAL QUE CREA PHP -------------
    move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);

    var_dump($_FILES);

    //$vars = get_object_vars ( $Obj );

?>