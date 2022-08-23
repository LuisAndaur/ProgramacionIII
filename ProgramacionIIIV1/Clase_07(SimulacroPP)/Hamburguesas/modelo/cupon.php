<?php

class Cupon{
    public $id;
    public $nro_devolucion;
    public $descuento;

    function setId($id){
        if (is_int($id) && !empty($id)) {
            $this->id = $id;
        }
    }

    public function getId(){
        return $this->id;
    }

    function setNroDevolucion($nro_devolucion){
        if (is_int($nro_devolucion) && !empty($nro_devolucion)) {
            $this->nro_devolucion = $nro_devolucion;
        }
    }

    public function getNroDevolucion(){
        return $this->nro_devolucion;
    }

    function setDescuento($descuento){

            $this->descuento = $descuento;

    }

    public function getDescuento(){
        return $this->descuento;
    }




    public static function AltaCupon($id,$nro_devolucion,$descuento){
        $cupon = new Cupon();
        $cupon->setId($id);
        $cupon->setNroDevolucion($nro_devolucion);
        $cupon->setDescuento($descuento);
        return $cupon;
    }

    public static function LeerCupones(){
        if(is_file('cupones.json')){
            $arrayJson = Json::LeerJson('cupones.json');
            if($arrayJson){
                $arrayCupones = array();
                foreach ($arrayJson as $index =>$upCupones) {
                    $upCupones = Cupon::AltaCupon($upCupones["id"],$upCupones["nro_devolucion"],$upCupones["descuento"]);
                    array_push($arrayCupones,$upCupones);
                }
                return $arrayCupones;
            }
            else{
                return null;
            }
        }
        return null;
    }

    public static function guardarCupon($cupon){
        $cupones = cupon::LeerCupones();
        if(!$cupones){
            $cupones = array();
            array_push($cupones, $cupon);
            Json::GuardarJson($cupones, 'cupones.json');
        }
        else{
            $auxCupones = array();
            foreach ($cupones as $index =>$upCupon) {
                if ($upCupon->equal($cupon)) {
                    array_push($auxCupones, $cupon);
                    array_splice($cupones, $index, 1, $auxCupones);
                }
            }
            Json::GuardarJson($cupones, 'cupones.json');
        }            
    }

    public function equal($obj):bool{
        if (is_a($obj,"Cupon") && $obj->getNroDevolucion() == $this->getNroDevolucion()) {
            return true;
        }
        return false;
    }




}




?>