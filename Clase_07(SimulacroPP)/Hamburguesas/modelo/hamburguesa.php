<?php
    require_once './datos/json.php';
    class Hamburguesa{
        public $id;
        public $nombre;
        public $precio;
        public $tipo;
        public $cantidad;
        public $imagen;

        function construct(){

        }

        public static function CrearHamburguesa($id=0, $nombre, $precio, $tipo, $cantidad,$imagen){
            $hamburguesa = new Hamburguesa();
            $hamburguesa->setId($id);
            $hamburguesa->setNombre($nombre);
            $hamburguesa->setPrecio($precio);
            $hamburguesa->setTipo($tipo);
            $hamburguesa->setCantidad($cantidad);
            $hamburguesa->setImagen($imagen);
            return $hamburguesa;
        }

        public function setId($id){
            if (isset($id) && is_numeric($id)){
                $this->id = $id;
            }
        }

        public function setNombre($nombre){
            if (isset($nombre)){
                $this->nombre = $nombre;
            }
        }

        public function setPrecio($precio){
            if (!empty($precio) && is_numeric($precio)){
                $this->precio = $precio;
            }
        }

        public function setTipo($tipo){
            if (isset($tipo)){
                $this->tipo = $tipo;
            }
        }

        public function setCantidad($cantidad){
            if ( is_numeric($cantidad)){
                $this->cantidad = $cantidad;
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

        public function getNombre(){
            return $this->nombre;
        }


        public function getPrecio(){
            return $this->precio;
        }


        public function getTipo(){
            return $this->tipo;
        }


        public function getCantidad(){
            return $this->cantidad;
        }

        public function getImagen(){
            return $this->imagen;
        }

        public static function LeerHamburguesas(){
            if(is_file('hamburguesa.json')){
                $arrayJson = Json::LeerJson('hamburguesa.json');
                if($arrayJson){
                    $arrayHamburguesa = array();
                    foreach ($arrayJson as $index =>$uphamburguesa) {
                        $uphamburguesa = Hamburguesa::CrearHamburguesa($uphamburguesa["id"],$uphamburguesa["nombre"],$uphamburguesa["precio"],$uphamburguesa["tipo"],$uphamburguesa["cantidad"],$uphamburguesa["imagen"]);
                        array_push($arrayHamburguesa,$uphamburguesa);
                    }
                    return $arrayHamburguesa;
                }
                else{
                    return null;
                }
            }
            return null;
        }

        public function equal($obj):bool{
            if (is_a($obj,"Hamburguesa") && $obj->getNombre() == $this->getNombre() && $obj->getTipo() == $this->getTipo()) {
                return true;
            }
            return false;
        }

        public function existeHamburguesa($arrayHamburguesas):bool{
            foreach ($arrayHamburguesas as $item) {
                if ($item->getNombre()==$this->getNombre() && $item->getTipo()==$this->getTipo()) {
                    return true;
                }
            }
            return false;
        }

        public static function guardarHamburguesa($hamburguesa){
            $hamburguesas = Hamburguesa::LeerHamburguesas();
            if(!$hamburguesas){
                $hamburguesas = array();
                array_push($hamburguesas, $hamburguesa);
                Json::GuardarJson($hamburguesas, 'hamburguesa.json');
            }
            else{
                $auxHamburguesas = array();
                foreach ($hamburguesas as $index =>$uphamburguesa) {
                    if ($uphamburguesa->equal($hamburguesa)) {
                        array_push($auxHamburguesas, $hamburguesa);
                        array_splice($hamburguesas, $index, 1, $auxHamburguesas);
                    }
                }
                Json::GuardarJson($hamburguesas, 'hamburguesa.json');
            }            
        }
        
        public static function Cargarhamburguesas($id, $nombre, $precio, $tipo, $cantidad, $imagen):string{
            $filePath = 'hamburguesa.json';
            $mensaje = '';
            $hamburguesa = Hamburguesa::CrearHamburguesa($id, $nombre, $precio, $tipo, $cantidad, $imagen);
            $hamburguesas = Hamburguesa::LeerHamburguesas();
            
            if (!$hamburguesa->existeHamburguesa($hamburguesas)) {
                    Hamburguesa::guardarHamburguesa($hamburguesa);
                    $mensaje = "Nueva hamburguesa agregada".PHP_EOL;
            }
            else{
                foreach ($hamburguesas as $uphamburguesa) {
                    if ($uphamburguesa->equal($hamburguesa)) {
                        $uphamburguesa->setCantidad($uphamburguesa->getCantidad() + $hamburguesa->getCantidad());
                        $uphamburguesa->setPrecio($hamburguesa->getPrecio());
                        Hamburguesa::guardarHamburguesa($uphamburguesa);
                        $mensaje =  "Hamburguesa actualizada".PHP_EOL;
                    }
                }
            }
            return $mensaje;
        }


        public static function Buscador($nombre, $tipo){
            $hamburguesas = Hamburguesa::LeerHamburguesas();
            foreach ($hamburguesas as $hamburguesa){
                if($hamburguesa->getNombre() == $nombre && $hamburguesa->getTipo() == $tipo){ 
                    return $hamburguesa;
                }
            }
            return null;
        }

    }
?>