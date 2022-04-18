<?php
    class Usuario{
        private $_nombre;
        private $_clave;
        private $_mail;

        function setNombre($nombre){
            if (is_string($nombre) && !empty($nombre)) {
                $this->_nombre = $nombre;
            }
        }

        function getNombre(){
            return $this->_nombre;
        }

        function setClave($clave){
            if (is_string($clave) && !empty($clave)) {
                $this->_clave = $clave;
            }
        }

        function getClave(){
            return $this->_clave;
        }

        function setMail($mail){
            if (is_string($mail) && !empty($mail)) {
                $this->_mail = $mail;
            }
        }

        function getMail(){
            return $this->_mail;
        }

        function __construct($nombre,$clave,$mail){
            $this->setNombre($nombre);
            $this->setClave($clave);
            $this->setMail($mail);
        }

        static function AltaUsuario($nombre,$clave,$mail){
            $usuario = null;
            if (is_string($nombre) && !empty($nombre) && is_string($clave) && !empty($clave) && is_string($mail) && !empty($mail)) {
                $usuario = new Usuario($nombre,$clave,$mail);
            }
            return $usuario;
        }

        function GuardarCSV($usuario):bool{
            $exito = false;            

            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $usuario->getNombre().",".$usuario->getClave().",".$usuario->getMail().PHP_EOL);
                $exito = true;
            }
            fclose($archivo);

            return $exito;
        }
    }
?>