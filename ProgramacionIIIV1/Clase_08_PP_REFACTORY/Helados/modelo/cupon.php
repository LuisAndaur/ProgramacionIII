<?php
require_once './datos/json.php';
class Cupon{
    public $id;
    public $devolucion_id;
    public $porcentajeDescuento;
    public $estado;

    function setId($id){
        if (is_int($id) && !empty($id)) {
            $this->id = $id;
        }
    }

    public function getId(){
        return $this->id;
    }

    function setNroDevolucion($devolucion_id){
        if (is_int($devolucion_id) ) {
            $this->devolucion_id = $devolucion_id;
        }
    }

    public function getNroDevolucion(){
        return $this->devolucion_id;
    }

    function setPorcentajeDescuento($porcentajeDescuento){
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }

    function setEstado($porcentajeDescuento){
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function getEstado(){
        return $this->porcentajeDescuento;
    }


    public static function AltaCupon($id,$devolucion_id,$porcentajeDescuento,$estado){
        $cupon = new Cupon();
        $cupon->setId($id);
        $cupon->setNroDevolucion($devolucion_id);
        $cupon->setPorcentajeDescuento($porcentajeDescuento);
        $cupon->setEstado($estado);
        return $cupon;
    }

    public static function LeerCupones(){
        if(is_file('cupones.json')){
            $arrayJson = Json::LeerJson('cupones.json');
            if($arrayJson){
                $arrayCupones = array();
                foreach ($arrayJson as $index =>$upCupones) {
                    $upCupones = Cupon::AltaCupon($upCupones["id"],$upCupones["devolucion_id"],$upCupones["porcentajeDescuento"],$upCupones["estado"]);
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

    public static function GuardarCupon($cupon){
        $cupones = Cupon::LeerCupones();
        if(!$cupones){
            $cupones = array();
            array_push($cupones, $cupon);
            Json::GuardarJson($cupones, 'cupones.json');
        }
        else{
            $auxCupones = array();
            foreach ($cupones as $index =>$upCupon) {
                if ($upCupon->Equal($cupon)) {
                    array_push($auxCupones, $cupon);
                    array_splice($cupones, $index, 1, $auxCupones);
                }
            }
            Json::GuardarJson($cupones, 'cupones.json');
        }            
    }

    public function Equal($obj):bool{
        if (is_a($obj,"Cupon") && $obj->getNroDevolucion() == $this->getNroDevolucion()) {
            return true;
        }
        return false;
    }




}




?>