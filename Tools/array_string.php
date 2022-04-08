<?php


private function GarageGetData(){
    $stringCars = $this->_razonSocial . "," . $this->_precioPorHora .PHP_EOL;
    foreach ($this->getAutos() as $auto) {
        $stringCars .= $auto->CartoRow();
    }
        
        return $stringCars;
    }



?>