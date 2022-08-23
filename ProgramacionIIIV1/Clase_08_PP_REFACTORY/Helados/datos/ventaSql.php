<?php
    include_once('./conexion/accesoDatos.php');
    include_once('./modelo/venta.php');
    class VentaSql{        

        public static function insertarVenta($venta){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "INSERT INTO venta (nro_pedido, sabor, tipo, usuario, cantidad, fecha_venta, imagen) 
                    VALUES (:nro_pedido, :sabor, :tipo, :usuario, :cantidad, :fecha_venta, :imagen)";
            
            $nro_pedido = $venta->getNroPedido();
            $sabor = $venta->getSabor();
            $tipo = $venta->getTipo();
            $usuario = $venta->getUsuario();
            $cantidad = $venta->getCantidad();
            $fecha = $venta->getFechaVenta();
            $imagen = $venta->getImagen();

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':nro_pedido', $nro_pedido, PDO::PARAM_INT);
            $sentencia->bindParam(':sabor', $sabor, PDO::PARAM_STR);
            $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $sentencia->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $sentencia->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $sentencia->bindParam(':fecha_venta', $fecha, PDO::PARAM_STR);
            $sentencia->bindParam(':imagen', $imagen, PDO::PARAM_STR);
            $sentencia->execute();

            return $pdo->RetornarUltimoIdInsertado();
        }

        public static function FechaParticular($fecha){
            $fechaAnterior = date('Y-m-d',strtotime('yesterday'));
            $pdo = AccesoDatos::dameAcceso();
            if($fecha){
                $sql = "SELECT * FROM venta WHERE fecha_venta = :fecha";
                $sentencia = $pdo->RetornarConsulta($sql);
                $sentencia->bindParam(':fecha', $fecha, PDO::PARAM_STR);                
            }
            else{
                $sql = "SELECT * FROM venta WHERE fecha_venta = :fechaAnterior";
                $sentencia = $pdo->RetornarConsulta($sql);
                $sentencia->bindParam(':fechaAnterior', $fechaAnterior, PDO::PARAM_STR);
            }            
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_CLASS,'Venta');
        }

        public static function EntreFechas($fecha1, $fecha2){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "SELECT * FROM venta WHERE fecha_venta BETWEEN :fecha1 AND :fecha2 ORDER BY nombre ASC";

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':fecha1', $fecha1, PDO::PARAM_STR);
            $sentencia->bindParam(':fecha2', $fecha2, PDO::PARAM_STR);
            $sentencia->execute();

            return $sentencia->fetchAll(PDO::FETCH_CLASS,'Venta');
        }

        public static function VentaUsuario($user){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "SELECT * FROM venta WHERE usuario = :user";

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':user', $user, PDO::PARAM_STR);
            $sentencia->execute();

            return $sentencia->fetchAll(PDO::FETCH_CLASS,'Venta');
        }

        public static function VentaSabor($sabor){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "SELECT * FROM venta WHERE sabor = :sabor";

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':sabor', $sabor, PDO::PARAM_STR);
            $sentencia->execute();

            return $sentencia->fetchAll(PDO::FETCH_CLASS,'Venta');
        }

        public static function ModificarVenta($nro_pedido, $usuario, $sabor, $tipo, $cantidad){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "UPDATE venta SET usuario = :usuario, sabor = :sabor, tipo = :tipo, cantidad = :cantidad WHERE nro_pedido = :nro_pedido";

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':nro_pedido', $nro_pedido, PDO::PARAM_INT);
            $sentencia->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $sentencia->bindParam(':sabor', $sabor, PDO::PARAM_STR);
            $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $sentencia->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $sentencia->execute();
        }

        public static function LeerPedido($nro_pedido){
            $pdo = AccesoDatos::dameAcceso();
            $sql = "SELECT * FROM venta WHERE nro_pedido = :nro_pedido";

            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':nro_pedido', $nro_pedido, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->fetchObject('Venta');
        }

        public static function BorrarVenta($nro_pedido){
            $estado = 0;
            $pdo = AccesoDatos::dameAcceso();
            $sql = "UPDATE venta SET estado = :estado WHERE nro_pedido = :nro_pedido";
            
            $sentencia = $pdo->RetornarConsulta($sql);
            $sentencia->bindParam(':nro_pedido', $nro_pedido, PDO::PARAM_INT);
            $sentencia->bindParam(':estado', $estado, PDO::PARAM_INT);
            $sentencia->execute();
        }









        // public static function getAllUsuarios(){
        //     $pdo = AccesoDatos::dameAcceso();
        //     $sql = "SELECT * FROM usuario";

        //     $sentencia = $pdo->RetornarConsulta($sql);
        //     $sentencia->execute();

        //     return $sentencia->fetchAll();
        // }

        // public static function VerificarUsuario($clave,$mail){
        //     $pdo = AccesoDatos::dameAcceso();
        //     $sql = "SELECT * FROM usuario WHERE clave = :clave AND mail = :mail";

        //     $sentencia = $pdo->RetornarConsulta($sql);
        //     $sentencia->bindParam(':clave', $clave, PDO::PARAM_STR);
        //     $sentencia->bindParam(':mail', $mail, PDO::PARAM_STR);

        //     $sentencia->execute();
        //     $sentencia->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        //     return $sentencia->fetch();
        // }
    }



?>