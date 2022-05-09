<?php
    require_once 'json.php';
    class Pizza{
        public $_id;
        public $_sabor;
        public $_precio;
        public $_tipo;
        public $_cantidad;

        public function __construct($id, $sabor, $precio, $tipo, $cantidad){
            $this->setID($id);
            $this->setSabor($sabor);
            $this->setPrecio($precio);
            $this->setTipo($tipo);
            $this->setCantidad($cantidad);
        }

        public function setID($id){
            if (isset($id) && is_numeric($id)){
                $this->_id = $id;
            }
        }

        public function setSabor($sabor){
            if (isset($sabor)){
                $this->_sabor = $sabor;
            }
        }

        public function setPrecio($precio){
            if (!empty($precio) && is_numeric($precio)){
                $this->_precio = $precio;
            }
        }

        public function setTipo($tipo){
            if (isset($tipo)){
                $this->_tipo = $tipo;
            }
        }

        public function setCantidad($cantidad){
            if (!empty($cantidad) && is_numeric($cantidad)){
                $this->_cantidad = $cantidad;
            }
        }

        public function getID(){
            return $this->_id;
        }

        public function getSabor(){
            return $this->_sabor;
        }


        public function getPrecio(){
            return $this->_precio;
        }


        public function getTipo(){
            return $this->_tipo;
        }


        public function getCantidad(){
            return $this->_cantidad;
        }

        public function equal($obj):bool{
            if (is_a($obj,"Pizza") && $obj->getSabor() == $this->getSabor() && $obj->getTipo() == $this->getTipo()) {
                return true;
            }
            return false;
        }

        public function existePizza($arraypizzas):bool{
            foreach ($arraypizzas as $auxPizza) {
                $auxPizza = new Pizza($auxPizza["_id"],$auxPizza["_sabor"],$auxPizza["_precio"],$auxPizza["_tipo"],$auxPizza["_cantidad"]);
                if ($auxPizza->getSabor() == $this->getSabor() && $auxPizza->getTipo() == $this->getTipo()) {
                    return true;
                }
            }
            return false;
        }
        
        public static function CargarPizzas($pizza, $accion):string{
            $filePath = 'Pizza.json';
            $mensaje = '';
            $pizzas = Json::LeerJson($filePath);
            
            if (!$pizza->existePizza($pizzas)) {
                if ($accion == "cargar") {
                    array_push($pizzas, $pizza);
                    $mensaje = "Nueva pizza agregada".PHP_EOL;
                }
            }else{
                $auxPizzas = array();
                foreach ($pizzas as $index =>$upPizza) {
                    $upPizza = new Pizza($upPizza["_id"],$upPizza["_sabor"],$upPizza["_precio"],$upPizza["_tipo"],$upPizza["_cantidad"]);
                    if ($upPizza->equal($pizza)) {
                        if($accion == "cargar"){
                            $upPizza->setCantidad($upPizza->getCantidad() + $pizza->getCantidad());
                            $upPizza->setPrecio($pizza->getPrecio());
                            array_push($auxPizzas, $upPizza);
                            array_splice($pizzas, $index, 1, $auxPizzas);
                            $mensaje =  "Pizza actualizada".PHP_EOL;
                        }
                    }
                }
            }

            if(Json::GuardarJson($pizzas, $filePath)){
                $mensaje2 =  "Guardado con éxito".PHP_EOL;
            }
            return $mensaje . $mensaje2;
        }


        public static function Buscador($sabor, $tipo){
            $array = Json::LeerJson('Pizza.json');
            $mensaje = "".PHP_EOL;
            $auxTipo = false;
            $auxSabor = false;

            foreach ($array as $pizza){
                $pizza = new Pizza($pizza["_id"],$pizza["_sabor"],$pizza["_precio"],$pizza["_tipo"],$pizza["_cantidad"]);
                if($pizza->getSabor() == $sabor){
                    $auxSabor = true;
                }
                if($pizza->getTipo() == $tipo){
                    $auxTipo = true;
                }
            }

            if($auxTipo && $auxSabor){
                $mensaje =  'Si Hay'.PHP_EOL;
            }else if(!$auxTipo){
                $mensaje = 'No existe el tipo: '.$tipo.PHP_EOL;
            }else if(!$auxSabor){
                $mensaje = 'No existe el sabor: '.$sabor.PHP_EOL;
            }else{
                $mensaje = 'No hay Pizzas '.$tipo.' ni de sabor '.$sabor.PHP_EOL;
            }

            return $mensaje;
        }
    }
?>