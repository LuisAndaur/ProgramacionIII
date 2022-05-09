<?php
    include_once('../datos/accesoDatos.php');
    class usuarioSql{        

        public static function insertarUsuario($usuario){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "INSERT INTO usuario (nombre, apellido, clave, mail, fecha_de_registro, localidad) 
                    VALUES (:nombre, :apellido, :clave, :mail, :fecha_de_registo, :localidad)";
            
            $nombre = $usuario->getNombre();
            $apellido = $usuario->getApellido();
            $clave = $usuario->getClave();
            $mail = $usuario->getMail();
            $fecha = $usuario->getFechaRegistro();
            $localidad = $usuario->getLocalidad();

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $sentencia->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $sentencia->bindParam(':clave', $clave, PDO::PARAM_STR);
            $sentencia->bindParam(':mail', $mail, PDO::PARAM_STR);
            $sentencia->bindParam(':fecha_de_registo', $fecha, PDO::PARAM_STR);
            $sentencia->bindParam(':localidad', $localidad, PDO::PARAM_STR);
            $sentencia->execute();

            return $pdo->RetornarUltimoIdInsertado();
        }
    }



?>