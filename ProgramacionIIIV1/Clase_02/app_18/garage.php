<?php
    require "auto.php";

    class Garage{
        private $_razonSocial;
        private $_precioPorHora;
        private $_autos;

        function GetRazonSocial()
        {
            return $this->_razonSocial;
        }

        function SetRazonSocial($value)
        {
            if(is_string($value)){
                $this->_razonSocial = $value;
            }
            else{
                $this->_razonSocial = ERROR_SET_RAZONSOCIAL;
            }
        }

        function GetPrecioPorHora()
        {
            return $this->_precioPorHora;
        }

        function SetPrecioPorHora($value)
        {
            if(is_double($value)){
                $this->_precioPorHora = $value;
            }
            else{
                $this->_precioPorHora = ERROR_SET_PRECIOXHORA;
            }
        }

        function GetAutos()
        {
            return $this->_autos;
        }

        function SetAutos($value)
        {
            if(is_array($value)){                
                $this->_autos = $value;
            }
            else{
                $this->_autos = ERROR_SET_AUTOS;
            }
        }

        function __construct($razonSocial, $precioPorHora = 0, $auto = array())
        {
            $this->SetRazonSocial($razonSocial);
            $this->SetPrecioPorHora($precioPorHora);
            $this->SetAutos($auto);
        }

        function MostrarGarage(){
            $contador = 1;
            echo "Descripción Garage" . "<br>";
            echo "Razon social: " . $this->GetRazonSocial() . "<br>";
            echo "Precio x hora: " . $this->GetPrecioPorHora() . "<br>";
            echo "Autos:" . "<br>";
            foreach($this->GetAutos() as $valor){
                echo "Auto N°" . $contador++ . "<br>";
                echo Auto::MostrarAuto($valor) . "<br>" ;
            }
        }

        function Equals($auto){
            if(is_a($auto,"Auto")){
                foreach($this->GetAutos() as $elemento){
                    if($elemento == $auto)
                    {
                        return "true";
                    }
                }
                return "false";
            }
        }

        function Add($auto){
            if(is_a($auto,"Auto")){
                foreach($this->GetAutos() as $elemento){
                    if($elemento == $auto)
                    {
                        return "El auto ya está";
                    }
                }
                array_push($this->_autos, $auto);
                return "Auto agregado";
            }
        }

        function Remove($auto){
            if (($clave = array_search($auto, $this->GetAutos()))) {
                unset($this->_autos[$clave]);
                return "Auto eliminado";
            }            
            return "El auto no estaba en el garage";
        }
    }

?>