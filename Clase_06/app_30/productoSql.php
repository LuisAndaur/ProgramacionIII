<?php
    include_once('../datos/accesoDatos.php');
    include_once('producto.php');
    class ProductoSql{        

        public static function insertarProducto($producto){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "INSERT INTO producto (codigo, nombre, tipo, stock, precio, fecha_de_registro) 
                    VALUES (:codigo, :nombre, :tipo, :stock, :precio, :fecha_de_registo)";
            
            $codigo = $producto->getCodigo();
            $nombre = $producto->getNombre();
            $tipo = $producto->getTipo();
            $stock = $producto->getStock();            
            $precio = $producto->getPrecio();
            $fecha = $producto->getFechaDeRegistro();

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $sentencia->bindParam(':stock', $stock, PDO::PARAM_INT);            
            $sentencia->bindParam(':precio', $precio, PDO::PARAM_STR);
            $sentencia->bindParam(':fecha_de_registo', $fecha, PDO::PARAM_STR);
            $sentencia->execute();

            return $pdo->RetornarUltimoIdInsertado();
        }

        public static function VerificarProducto($producto){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "INSERT INTO producto (codigo, nombre, tipo, stock, precio, fecha_de_registro) 
                    VALUES (:codigo, :nombre, :tipo, :stock, :precio, :fecha_de_registo)";
            
            $codigo = $producto->getCodigo();
            $nombre = $producto->getNombre();
            $tipo = $producto->getTipo();
            $stock = $producto->getStock();            
            $precio = $producto->getPrecio();
            $fecha = $producto->getFechaRegistro();

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $sentencia->bindParam(':stock', $stock, PDO::PARAM_INT);            
            $sentencia->bindParam(':precio', $precio, PDO::PARAM_STR);
            $sentencia->bindParam(':fecha_de_registo', $fecha, PDO::PARAM_STR);
            $sentencia->execute();

            return $pdo->RetornarUltimoIdInsertado();
        }

        // public static function getAllproductos(){
        //     $pdo = AccesoDatos::dameAcceso();
        //     $sql = "SELECT * FROM producto";

        //     $sentencia = $pdo->RetornarConsulta($sql);
        //     $sentencia->execute();

        //     return $sentencia->fetchAll();
        // }

        // public static function Verificarproducto($clave,$mail){
        //     $pdo = AccesoDatos::dameAcceso();
        //     $sql = "SELECT * FROM producto WHERE clave = :clave AND mail = :mail";

        //     $sentencia = $pdo->RetornarConsulta($sql);
        //     $sentencia->bindParam(':clave', $clave, PDO::PARAM_STR);
        //     $sentencia->bindParam(':mail', $mail, PDO::PARAM_STR);

        //     $sentencia->execute();
        //     $sentencia->setFetchMode(PDO::FETCH_CLASS, 'producto');
        //     return $sentencia->fetch();
        // }
    }



?>