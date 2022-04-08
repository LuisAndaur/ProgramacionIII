<?php
    //----  SETTERS -----
    /**
     * Sets el name del user.
     * @param string $name El name del user.
     */
    function setName($name){
        if (is_string($name) && !empty($name)) {
            $this->_name = $name;
        }
    }

    /**
     * Sets el precio del coche si es superior a 0.
     * @param float $precio Precio del coche.
     */
    function setPrecio($precio){
        if (is_float($precio) && $precio > 0) {
            $this->_precio = $precio;
        }
    }



    //----  GETTERS -----
    /**
     * Retorna el name del user.
     * @return string El name of the user.
     */
    function getName(){
        return $this->_name;
    }

?>