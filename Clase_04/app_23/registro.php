<?php
    require_once("usuario.php");
    require_once("../../Tools/json.php");

    if(!is_dir('app_23/')){
		mkdir('app_23/', 0777);
	}
    $destino = "app_23/";
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $nombre = $_POST["nombre"];
            $clave = $_POST["clave"];
            $mail = $_POST["mail"];
            if (isset($_POST['image'])) {
                //Recogemos el archivo enviado por el formulario
                $archivo = $_FILES['archivo']['name'];
                //Si el archivo contiene algo y es diferente de vacio
                if (isset($archivo) && $archivo != "") {
                   //Obtenemos algunos datos necesarios sobre el archivo
                   $tipo = $_FILES['archivo']['type'];
                   $tamano = $_FILES['archivo']['size'];
                   $temp = $_FILES['archivo']['tmp_name'];
                   var_dump($_FILES);
                   //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                  if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                     echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                     - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                  }
                  else {
                     //Si la imagen es correcta en tamaño y tipo
                     //Se intenta subir al servidor
                     if (move_uploaded_file($temp, $destino.$archivo)) {
                         //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                         chmod($destino.$archivo, 0777);
                         //Mostramos el mensaje de que se ha subido co éxito
                         echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                         //Mostramos la imagen subida
                         echo '<p><img src="' . $destino . $archivo.'"></p>';
                     }
                     else {
                        //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                     }
                   }
                }
             }

            $fechaRegistro = new DateTime("now");
            $newId = rand(1,10001);
            $usuario = Usuario::AltaUsuario($newId,$nombre, $clave, $mail, $fechaRegistro->format('d-m-Y H:m:s'));

            if (!file_exists($destino)) {
                move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
            }


            $usuarios = Json::LeerJson();
            array_push($usuarios,$usuario);

            if(Json::GuardarJSON($usuarios))
            {
                echo "Usuario agregado con éxito";
            }
            break;
        
        default:
            echo "ERROR: Petición no válida";
            break;
    }
?>