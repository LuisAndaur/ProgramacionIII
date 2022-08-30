<?php
    require_once('./datos/json.php');
    class Helado{
        public $id;
        public $sabor;
        public $precio;
        public $tipo;
        public $stock;
        public $imagen;

        function construct(){

        }

        public static function CrearObjeto($id, $sabor, $precio, $tipo, $stock,$imagen){
            $obj = new Helado();
            $obj->setId($id);
            $obj->setSabor($sabor);
            $obj->setPrecio($precio);
            $obj->setTipo($tipo);
            $obj->setStock($stock);
            $obj->setImagen($imagen);
            return $obj;
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

        public static function ListarObjetos($archivo){
            $retorno = null;
            if(is_file($archivo)){
                $arrayJson = Json::LeerJson($archivo);
                if($arrayJson){
                    $auxArray = array();
                    foreach ($arrayJson as $valor) {
                        $valor = Helado::CrearObjeto($valor['id'],$valor['sabor'],$valor['precio'],$valor['tipo'],$valor['stock'],$valor['imagen']);
                        array_push($auxArray,$valor);
                    }      
                    $retorno = $auxArray;   
                }
            }
            return $retorno;
        }

        public function Equal($obj):bool{
            if ($obj->getSabor() == $this->getSabor() && $obj->getTipo() == $this->getTipo()) {
                return true;
            }
            return false;
        }

        public function Existe($arrayObj):bool{
            if($arrayObj){
                foreach($arrayObj as $item) {
                    if ($item->getSabor()==$this->getSabor() && $item->getTipo()==$this->getTipo()) {
                        return true;
                    }
                }
            }
            return false;
        }

        public static function Guardar($obj, $archivo){
            $existe = false;
            $arrayObj = Helado::ListarObjetos($archivo);
            if(!$arrayObj){
                $arrayObj = array();
                array_push($arrayObj, $obj);
                Json::GuardarJson($arrayObj, $archivo);
            }
            else{
                $auxArray = array();
                foreach ($arrayObj as $index =>$auxObj) {
                    if ($auxObj->Equal($obj)) {
                        array_push($auxArray, $obj);
                        array_splice($arrayObj, $index, 1, $auxArray);
                        $existe = true;
                        break;
                    }
                }
                if(!$existe){
                    array_push($arrayObj, $obj);
                }
                Json::GuardarJson($arrayObj, $archivo);
            }            
        }
        
        public static function Cargar($id, $sabor, $precio, $tipo, $stock, $imagen, $archivo):string{
            $mensaje = '';
            $obj = Helado::CrearObjeto($id, $sabor, $precio, $tipo, $stock, $imagen);
            $arrayObj = Helado::ListarObjetos($archivo);
            
            if (!$obj->Existe($arrayObj)) {
                    Helado::Guardar($obj,$archivo);
                    $mensaje = "Nueva carga agregada".PHP_EOL;
            }
            else{
                foreach ($arrayObj as $auxObj) {
                    if ($auxObj->Equal($obj)) {
                        $auxObj->setStock($auxObj->getStock() + $obj->getStock());
                        $auxObj->setPrecio($obj->getPrecio());
                        Helado::Guardar($auxObj,$archivo);
                        $mensaje =  "Lista actualizada".PHP_EOL;
                    }
                }
            }
            return $mensaje;
        }


        public static function Buscador($sabor, $tipo, $archivo){
            $arrayObj = Helado::ListarObjetos($archivo);
            foreach ($arrayObj as $item){
                if($item->getSabor() == $sabor && $item->getTipo() == $tipo){ 
                    return $item;
                }
            }
            return null;
        }
    }
?>