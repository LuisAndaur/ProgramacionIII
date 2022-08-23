<?php

require_once './datos/json.php';

class Devolucion{
    public $id;
    public $nro_pedido;
    public $causa;
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

    function setCausa($causa){
        if (is_string($causa) && !empty($causa)) {
            $this->causa = $causa;
        }
    }

    function getCausa(){
        return $this->causa;
    }

    function setImagen($imagen){
        if (is_string($imagen) && !empty($imagen)) {
            $this->imagen = $imagen;
        }
    }

    function getImagen(){
        return $this->imagen;
    }


    public static function AltaDevolucion($id,$nro_pedido,$causa,$imagen){
        $devolucion = new Devolucion();
        $devolucion->setId($id);
        $devolucion->setNroPedido($nro_pedido);
        $devolucion->setCausa($causa);
        $devolucion->setImagen($imagen);
        return $devolucion;
    }

    public static function LeerDevoluciones(){
        if(is_file('devoluciones.json')){
            $arrayJson = Json::LeerJson('devoluciones.json');
            if($arrayJson){
                $arrayDevoluciones = array();
                foreach ($arrayJson as $index =>$upDevoluciones) {
                    $upDevoluciones = Devolucion::AltaDevolucion($upDevoluciones["id"],$upDevoluciones["nro_pedido"],$upDevoluciones["causa"],$upDevoluciones["imagen"]);
                    array_push($arrayDevoluciones,$upDevoluciones);
                }
                return $arrayDevoluciones;
            }
            else{
                return null;
            }
        }
        return null;
    }

    public static function guardarDevolucion($devolucion){
        $devoluciones = Devolucion::LeerDevoluciones();
        if(!$devoluciones){
            $devoluciones = array();
            array_push($devoluciones, $devolucion);
            Json::GuardarJson($devoluciones, 'devolucion.json');
        }
        else{
            $auxDevoluciones = array();
            foreach ($devoluciones as $index =>$updevolucion) {
                if ($updevolucion->equal($devolucion)) {
                    array_push($auxDevoluciones, $devolucion);
                    array_splice($devoluciones, $index, 1, $auxDevoluciones);
                }
            }
            Json::GuardarJson($devoluciones, 'devolucion.json');
        }            
    }

    public function equal($obj):bool{
        if (is_a($obj,"Devolucion") && $obj->getNroPedido() == $this->getNroPedido()) {
            return true;
        }
        return false;
    }




}




?>