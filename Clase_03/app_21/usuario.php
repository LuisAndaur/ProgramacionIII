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

        public static function AltaUsuario($nombre,$clave,$mail){
            $usuario = null;
            if (is_string($nombre) && !empty($nombre) && is_string($clave) && !empty($clave) && is_string($mail) && !empty($mail)) {
                $usuario = new Usuario($nombre,$clave,$mail);
            }
            return $usuario;
        }

        private static function ListaUsuarios($usuarios=array()):bool{
            $exito = false;
            echo "<ul>";
            foreach ($usuarios as $usuario) {
                echo "<li>".$usuario->getNombre()."</li>";
                echo "<li>".$usuario->getClave()."</li>";
                echo "<li>".$usuario->getMail()."</li>";
                $exito = true;
            }
            echo "</ul>";
    
            return $exito;
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

        static function LeerCsv($archivoRecibido="usuarios.csv"):bool{
            $exito = false;
            $archivo = fopen($archivoRecibido, "r");
            $usuarios = array();

            while (!feof($archivo)) {
                $linea = fgets($archivo);
                if (!empty($linea)) {
                    $linea = str_replace(PHP_EOL, "", $linea);
                    $userArray = explode(",", $linea);
                    array_push($usuarios, new Usuario($userArray[0], $userArray[1], $userArray[2]));
                }
            }

            fclose($archivo);
            if(Usuario::ListaUsuarios($usuarios)){
                $exito = true;
            }

            return $exito;
        }
    }
?>