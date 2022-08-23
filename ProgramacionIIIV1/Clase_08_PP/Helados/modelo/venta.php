<?php
require_once 'helado.php';
require_once './datos/ventaSql.php';
class Venta{
    public $id;
    public $nro_pedido;
    public $sabor;
    public $tipo;
    public $usuario;
    public $cantidad;
    public $fecha_venta;
    public $imagen;

    function setId($id){
        if (is_int($id) && !empty($id)) {
            $this->id = $id;
        }
    }

    public function getId(){
        return $this->id;
    }

    function setNroPedido($nro_pedido){
        if (is_int($nro_pedido) && !empty($nro_pedido)) {
            $this->nro_pedido = $nro_pedido;
        }
    }

    public function getNroPedido(){
        return $this->nro_pedido;
    }

    function setSabor($sabor){
        if (is_string($sabor) && !empty($sabor)) {
            $this->sabor = $sabor;
        }
    }

    function getSabor(){
        return $this->sabor;
    }

    function setTipo($tipo){
        if (is_string($tipo) && !empty($tipo)) {
            $this->tipo = $tipo;
        }
    }

    function getTipo(){
        return $this->tipo;
    }

    function setUsuario($usuario){
        if (is_string($usuario) && !empty($usuario)) {
            $this->usuario = $usuario;
        }
    }

    function getUsuario(){
        return $this->usuario;
    }

    function setCantidad($cantidad){
        if (is_int($cantidad) && !empty($cantidad)) {
            $this->cantidad = $cantidad;
        }
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    function setFechaVenta($fecha_venta){
        if (is_string($fecha_venta) && !empty($fecha_venta)) {
            $this->fecha_venta = $fecha_venta;
        }
    }

    function getFechaVenta(){
        return $this->fecha_venta;
    }

    function setImagen($imagen){
        if (is_string($imagen) && !empty($imagen)) {
            $this->imagen = $imagen;
        }
    }

    function getImagen(){
        return $this->imagen;
    }

    function construct(){

    }

    public static function CrearVenta($sabor,$tipo,$usuario,$cantidad,$imagen = ""){
        $venta = new Venta();
        $venta->setNroPedido(rand(1,10001));
        $venta->setSabor($sabor);
        $venta->setTipo($tipo);
        $venta->setUsuario($usuario);
        $venta->setCantidad($cantidad);
        $venta->setFechaVenta(date('Y-m-d'));
        $venta->setImagen($imagen);
        return $venta;
    }


    public static function AltaVenta($mail,$sabor,$tipo,$cantidad,$imagen){
        $helado = Helado::Buscador($sabor,$tipo);
        if($helado){
            if($helado->getStock() >= $cantidad && $cantidad>0){
                $helado->setStock($helado->getStock() - $cantidad);
                
                Helado::GuardarHelado($helado);                 
                $usuario = explode('@', $mail);
                $venta = Venta::CrearVenta($sabor,$tipo,$usuario[0],$cantidad,$imagen);
                VentaSql::insertarVenta($venta);
            }
            else{
                echo "No hay stock de la helado".PHP_EOL;
            }    
        }
        else{
            echo "No existe la helado".PHP_EOL;
        }
        
    }

    public static function VentaParticular($fecha){
        $lista = VentaSql::FechaParticular($fecha);
        if ($lista) {
            echo "<ul>";
            foreach ($lista as $item) {
                echo "<li>".$item->getId()."</li>";
                echo "<li>".$item->getNroPedido()."</li>";
                echo "<li>".$item->getSabor()."</li>";
                echo "<li>".$item->getTipo()."</li>";
                echo "<li>".$item->getUsuario()."</li>";
                echo "<li>".$item->getCantidad()."</li>";
                echo "<li>".$item->getFechaVenta()."</li>";
                echo "<li><img src='".$item->getImagen()."'></li>";
            }
            echo "</ul>";
        }
    }

    public static function VentaEntreFechas($fecha1, $fecha2){
        $lista = VentaSql::EntreFechas($fecha1, $fecha2);
        if ($lista) {
            echo "<ul>";
            foreach ($lista as $item) {
                echo "<li>".$item->getId()."</li>";
                echo "<li>".$item->getNroPedido()."</li>";
                echo "<li>".$item->getSabor()."</li>";
                echo "<li>".$item->getTipo()."</li>";
                echo "<li>".$item->getUsuario()."</li>";
                echo "<li>".$item->getCantidad()."</li>";
                echo "<li>".$item->getFechaVenta()."</li>";
                echo "<li><img src='".$item->getImagen()."'></li>";
            }
            echo "</ul>";
        }
    }

    public static function VentaDeUsuario($user){
        $lista = VentaSql::VentaUsuario($user);
        if ($lista) {
            echo "<ul>";
            foreach ($lista as $item) {
                echo "<li>".$item->getId()."</li>";
                echo "<li>".$item->getNroPedido()."</li>";
                echo "<li>".$item->getSabor()."</li>";
                echo "<li>".$item->getTipo()."</li>";
                echo "<li>".$item->getUsuario()."</li>";
                echo "<li>".$item->getCantidad()."</li>";
                echo "<li>".$item->getFechaVenta()."</li>";
                echo "<li><img src='".$item->getImagen()."'></li>";
            }
            echo "</ul>";
        }
    }

    public static function VentaDeSabor($sabor){
        $lista = VentaSql::VentaSabor($sabor);
        if ($lista) {
            echo "<ul>";
            foreach ($lista as $item) {
                echo "<li>".$item->getId()."</li>";
                echo "<li>".$item->getNroPedido()."</li>";
                echo "<li>".$item->getSabor()."</li>";
                echo "<li>".$item->getTipo()."</li>";
                echo "<li>".$item->getUsuario()."</li>";
                echo "<li>".$item->getCantidad()."</li>";
                echo "<li>".$item->getFechaVenta()."</li>";
                echo "<li><img src='".$item->getImagen()."'></li>";
            }
            echo "</ul>";
        }
    }










}




?>