<?php
    require_once './datos/json.php';
    class Helado{
        public $id;
        public $sabor;
        public $precio;
        public $tipo;
        public $stock;
        public $imagen;

        function construct(){

        }

        public static function CrearHelado($id=0, $sabor, $precio, $tipo, $stock,$imagen){
            $helado = new helado();
            $helado->setId($id);
            $helado->setSabor($sabor);
            $helado->setPrecio($precio);
            $helado->setTipo($tipo);
            $helado->setStock($stock);
            $helado->setImagen($imagen);
            return $helado;
        }

        public function setId($id){
            if (isset($id) && is_numeric($id)){
                $this->id = $id;
            }
        }

        public function setSabor($sabor){
            if (isset($sabor)){
                $this->sabor = $sabor;
            }
        }

        public function setPrecio($precio){
            if (!empty($precio) && is_numeric($precio)){
                $this->precio = $precio;
            }
        }

        public function setTipo($tipo){
            if (isset($tipo) && ($tipo =='agua' || $tipo =='crema')){
                $this->tipo = $tipo;
            }
        }

        public function setStock($stock){
            if ( is_numeric($stock)){
                $this->stock = $stock;
            }
        }

        public function setImagen($imagen){
            if (isset($imagen)){
                $this->imagen = $imagen;
            }
        }

        public function getId(){
            return $this->id;
        }

        public function getSabor(){
            return $this->sabor;
        }


        public function getPrecio(){
            return $this->precio;
        }


        public function getTipo(){
            return $this->tipo;
        }


        public function getStock(){
            return $this->stock;
        }

        public function getImagen(){
            return $this->imagen;
        }

        public static function LeerHelados(){
            if(is_file('heladeria.json')){
                $arrayJson = Json::LeerJson('heladeria.json');
                
                if($arrayJson){
                    $arrayhelado = array();
                    foreach ($arrayJson as $index =>$uphelado) {
                        $uphelado = Helado::CrearHelado($uphelado["id"],$uphelado["sabor"],$uphelado["precio"],$uphelado["tipo"],$uphelado["stock"],$uphelado["imagen"]);
                        array_push($arrayhelado,$uphelado);
                    }
                    
                    return $arrayhelado;
                    
                }
                else{
                    return null;
                }
            }
            return null;
        }

        public function equal($obj):bool{
            if (is_a($obj,"Helado") && $obj->getSabor() == $this->getSabor() && $obj->getTipo() == $this->getTipo()) {
                return true;
            }
            return false;
        }

        public function ExisteHelado($arrayHelados):bool{
            foreach ($arrayHelados as $item) {
                if ($item->getSabor()==$this->getSabor() && $item->getTipo()==$this->getTipo()) {
                    return true;
                }
            }
            return false;
        }

        public static function GuardarHelado($helado){
            $helados = Helado::LeerHelados();
            if(!$helados){
                $helados = array();
                array_push($helados, $helado);
                Json::GuardarJson($helados, 'heladeria.json');
            }
            else{
                $auxhelados = array();
                foreach ($helados as $index =>$uphelado) {
                    if ($uphelado->Equal($helado)) {
                        array_push($auxhelados, $helado);             
                        array_splice($helados, $index, 1, $auxhelados);
                    }
                }
                Json::GuardarJson($helados, 'heladeria.json');
            }            
        }
        
        public static function Cargarhelados($id, $sabor, $precio, $tipo, $stock, $imagen):string{
            $mensaje = '';
            $helado = Helado::CrearHelado($id, $sabor, $precio, $tipo, $stock, $imagen);
            $helados = Helado::LeerHelados();
            
            if (!$helado->ExisteHelado($helados)) {
                    Helado::GuardarHelado($helado);
                    $mensaje = "Nueva helado agregada".PHP_EOL;
            }
            else{
                foreach ($helados as $uphelado) {
                    if ($uphelado->Equal($helado)) {
                        $uphelado->setStock($uphelado->getStock() + $helado->getStock());
                        $uphelado->setPrecio($helado->getPrecio());
                        Helado::GuardarHelado($uphelado);
                        $mensaje =  "Helado actualizada".PHP_EOL;
                    }
                }
            }
            return $mensaje;
        }


        public static function Buscador($sabor, $tipo){
            $helados = Helado::LeerHelados();
            foreach ($helados as $helado){
                if($helado->getSabor() == $sabor && $helado->getTipo() == $tipo){ 
                    return $helado;
                }
            }
            return null;
        }

    }
?>