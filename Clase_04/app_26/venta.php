<?php
    class Venta{
        public $_id;
        public $_codProducto;
        public $_idUsuario;
        public $_cantidad;

        function setId($id){
            if (is_int($id) && !empty($id)) {
                $this->_id = $id;
            }
        }

        public function getId(){
            return $this->_id;
        }

        function setCodProducto($codProducto){
            if (is_string($codProducto) && !empty($codProducto)) {
                $this->_codProducto = $codProducto;
            }
        }

        function getCodProducto(){
            return $this->_codProducto;
        }

        function setIdUsuario($idUsuario){
            if (is_int($idUsuario) && !empty($idUsuario)) {
                $this->_idUsuario = $idUsuario;
            }
        }

        public function getIdUsuario(){
            return $this->_idUsuario;
        }

        function setCantidad($cantidad){
            if (is_int($cantidad) && !empty($cantidad) && $cantidad>-1) {
                $this->_cantidad = $cantidad;
            }
        }

        function getCantidad(){
            return $this->_cantidad;
        }

        function __construct($id,$codProducto,$idUsuario,$cantidad){
            $this->setId($id);
            $this->setCodProducto($codProducto);
            $this->setIdUsuario($idUsuario);
            $this->setCantidad($cantidad);
        }

        public static function AltaVenta($id,$codProducto,$idUsuario,$cantidad){
            $venta = null;
            if (is_int($id) && !empty($id) && is_string($codProducto) && !empty($codProducto) && is_int($idUsuario) && !empty($idUsuario) && is_int($cantidad) && !empty($cantidad) && $cantidad>0) {
                $venta = new Venta($id,$codProducto,$idUsuario,$cantidad);
            }
            return $venta;
        }

        public static function ListaVentas($ventas=array()):bool{
            $exito = false;
            echo "<ul>";
            foreach ($ventas as $venta) {
                echo "<li>".$venta["_id"]."</li>";
                echo "<li>".$venta["_codProducto"]."</li>";
                echo "<li>".$venta["_idUsuario"]."</li>";
                echo "<li>".$venta["_cantidad"]."</li>";
                $exito = true;
            }
            echo "</ul>";
    
            return $exito;
        }

    }
?>