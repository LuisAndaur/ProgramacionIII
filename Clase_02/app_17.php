<?php
    class Auto{
        private $_color;
        private $_precio;
        private $_marca;
        private $_fecha;

        public function __construct($color, $marca, $precio = 0, $fecha = null ){
            $this->_color = $color;
            $this->_marca = $marca;
            $this->_precio = $precio;
            if($fecha==null){
                $this->_fecha = date("d.m.y");
            }
        }

        function AgregarImpuestos($valor){
            return $this->_precio += $valor;
        }

        static function MostrarAuto($auto){
            if(is_a($auto,"Auto")){
                echo "Marca: " . $auto->_marca . "<br>";
                echo "Color: " . $auto->_color . "<br>";
                echo "Precio: " . $auto->_precio . "<br>";
                echo "Fecha: " . $auto->_fecha . "<br>";
            }
            else{
                echo "No es un auto" . "<br>";
            }
        }

        function Equals($auto){
            if(is_a($auto,"Auto")){
                if($this->_marca == $auto->_marca){
                    return true;
                }
                else{
                    return 0;
                }
            }
            else{
                echo "No es un auto" . "<br>";
            }
        }

        static function Add($auto1, $auto2){
            if(is_a($auto1,"Auto") && is_a($auto2,"Auto")){
                if($auto1->_marca == $auto2->_marca && $auto1->_color == $auto2->_color){
                    return $auto1->_precio + $auto2->_precio;
                }
                else{
                    echo "Los autos son de distinta marca y/o color" . "<br>";
                    return 0;
                }
            }
            else{
                echo "No es un auto" . "<br>";
            }
        }

 
    }
?>