<?php
require_once("auto.php");
    class Garage{
        private $_razonSocial;
        private $_precioPorHora;
        private $_autos;

        function __construct($razonSocial, $precioPorHora=0, $autos=array()){
            $this->_razonSocial = $razonSocial;
            $this->_precioPorHora = $precioPorHora;
            $this->_autos = $autos;
        }

        public function mostrarGarage(){
            $contador = 1;
            echo "GARAGE" . PHP_EOL;
            echo "Razon social: " . $this->_razonSocial . PHP_EOL;
            echo "Precio x hora: " . $this->_precioPorHora . PHP_EOL;
            echo "Autos: " . PHP_EOL;
            foreach($this->_autos as $auto){
                echo "Auto N°" . $contador++ . PHP_EOL;
                echo Auto::mostrarAuto($auto) . PHP_EOL;
            }
        }

        public function equals($auto){
            if(is_a($auto,"Auto")){
                foreach($this->_autos as $auxAuto){
                    if($auxAuto == $auto){
                        return true;
                    }
                }
                return 0;
            }
            return -1;
        }

        public function add($auto){
            if($this->equals($auto)){
                array_push($this->_autos, $auto);
                echo "Auto agregado" . PHP_EOL;
            }
            else{
                echo "El auto ya esta en el garage" . PHP_EOL; 
            }
        }

        public function remove($auto){
            if(!$this->equals($auto)){
                $clave = array_search($auto, $this->_autos);
                unset($this->_autos[$clave]);
                echo "Auto eliminado"  . PHP_EOL;
            }
            else{
                echo "El auto no estaba en el garage" . PHP_EOL; 
            }
        }
    }
?>