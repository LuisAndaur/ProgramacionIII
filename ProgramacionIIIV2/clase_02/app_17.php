<?php
date_default_timezone_set('America/Buenos_Aires');
    class Auto{
        private $_color;
        private $_precio;
        private $_marca;
        private $_fecha;

        function __construct($marca, $color, $precio=0, $fecha = null )
        {
            $this->_marca = $marca;
            $this->_color = $color;
            $this->_precio = $precio;
            if($fecha==null){
                $this->_fecha = date("d.m.Y");
            }
        }

        public function agregarImpuestos($impuesto){
            return $this->_precio += $impuesto;
        }

        static function mostrarAuto($auto){
            if(is_a($auto,"Auto")){
                echo "Marca: " . $auto->_marca . PHP_EOL;
                echo "Color: " . $auto->_color . PHP_EOL;
                echo "Precio: " . $auto->_precio . PHP_EOL;
                echo "fecha: " . $auto->_fecha . PHP_EOL;
            }
            else{
                echo "No es un auto";
            }
        }

        public function equals($auto){
            if(is_a($auto,"Auto")){
                if($this->_marca == $auto->_marca){
                    return true;
                }
                else{
                    return 0;
                }
            }
            else{
                echo "No es un auto";
            }
        }

        static function add($auto1, $auto2){
            if(is_a($auto1,"Auto") && is_a($auto2,"Auto")){
                if($auto1->_marca == $auto2->_marca && $auto1->_color == $auto2->_color){
                    return $auto1->_precio + $auto2->_precio;
                }
                else{
                    return 0;
                }
            }
            else{
                echo "No es un auto";
            }
        }
    }
?>