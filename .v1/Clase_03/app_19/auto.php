<?php

    class Auto{
        private $_color;
        private $_precio;
        private $_marca;
        private $_fecha;

        function GetColor()
        {
            return $this->_color;
        }

        function SetColor($value)
        {
            if(is_string($value)){
                $this->_color = $value;
            }
            else{
                $this->_color = "error color";
            }
        }

        function GetMarca()
        {
            return $this->_marca;
        }

        function SetMarca($value)
        {
            if(is_string($value)){
                $this->_marca = $value;
            }
            else{
                $this->_marca = "error";
            }
        }

        public function __construct($color, $marca, $precio = 0, $fecha = null ){
            $this->SetColor($color);
            $this->SetMarca($marca);
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
                echo "Marca: " . $auto->GetMarca() . "<br>";
                echo "Color: " . $auto->GetColor() . "<br>";
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

        static function ToString($auto){
            $string = "$auto->_marca,$auto->_color,$auto->_precio,$auto->_fecha<br>";
            return $string;
        }

        static function AltaAuto($auto){
            if(is_a($auto,"Auto")){
                $archivo = fopen("autos.csv", "a+");

                $autos = Auto::ToString($auto);
                fputs($archivo, $autos);
                fclose($archivo);
            }
        }

        static function LeerListado($archivo){
            $archivo = fopen($archivo, "r");

            while(!feof($archivo)){
                echo fgets($archivo);
            }

            fclose($archivo);
        }
    }
?>