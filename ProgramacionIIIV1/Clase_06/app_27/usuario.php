<?php
    include_once("usuarioSql.php");
    class Usuario{
        public $_id;
        public $_nombre;
        public $_apellido;
        public $_clave;
        public $_mail;
        public $_fechaRegistro;
        public $_localidad;

        function setId($id){
            if (is_int($id) && !empty($id)) {
                $this->_id = $id;
            }
        }

        public function getId(){
            return $this->_id;
        }

        function setNombre($nombre){
            if (is_string($nombre) && !empty($nombre)) {
                $this->_nombre = $nombre;
            }
        }

        function getNombre(){
            return $this->_nombre;
        }

        function setApellido($apellido){
            if (is_string($apellido) && !empty($apellido)) {
                $this->_apellido = $apellido;
            }
        }

        function getApellido(){
            return $this->_apellido;
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

        function setFechaRegistro($fechaRegistro){
            if (is_string($fechaRegistro) && !empty($fechaRegistro)) {
                $this->_fechaRegistro = $fechaRegistro;
            }
        }

        function getFechaRegistro(){
            return $this->_fechaRegistro;
        }

        function setLocalidad($localidad){
            if (is_string($localidad) && !empty($localidad)) {
                $this->_localidad = $localidad;
            }
        }

        function getLocalidad(){
            return $this->_localidad;
        }

        function __construct($id,$nombre,$apellido,$clave,$mail,$fechaRegistro,$localidad){
            $this->setId($id);
            $this->setNombre($nombre);
            $this->setApellido($apellido);
            $this->setClave($clave);
            $this->setMail($mail);
            $this->setFechaRegistro($fechaRegistro);
            $this->setlocalidad($localidad);
        }

        public static function AltaUsuario($nombre,$apellido,$clave,$mail,$fechaRegistro,$localidad):bool{
            $respuesta = false;
            $id = 0;
            if (is_string($nombre) && !empty($nombre)&& is_string($apellido) && !empty($apellido) && is_string($clave) && !empty($clave) && is_string($mail) && !empty($mail) && is_string($fechaRegistro) && !empty($fechaRegistro) && is_string($localidad) && !empty($localidad)) {
                $usuario = new Usuario($id,$nombre,$apellido,$clave,$mail,$fechaRegistro,$localidad);
                $ultimoId = usuarioSql::insertarUsuario($usuario);
                if ($usuario!=null && $ultimoId>0) {
                    $respuesta = true;
                }
            }
            return $respuesta;
        }

        public static function ListaUsuarios($usuarios=array()):bool{
            $exito = false;
            echo "<ul>";
            foreach ($usuarios as $usuario) {
                echo "<li>".$usuario["_id"]."</li>";
                echo "<li>".$usuario["_nombre"]."</li>";
                echo "<li>".$usuario["_apellido"]."</li>";
                echo "<li>".$usuario["_clave"]."</li>";
                echo "<li>".$usuario["_mail"]."</li>";
                echo "<li>".$usuario["_fechaRegistro"]."</li>";
                echo "<li>".$usuario["_localidad"]."</li>";
                $exito = true;
            }
            echo "</ul>";
            return $exito;
        }

        function GuardarCSV($usuario):bool{
            $exito = false;            

            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $usuario->getNombre().",".$usuario->getApellido().",".$usuario->getClave().",".$usuario->getMail().",".$usuario->getFechaRegistro().",".$usuario->getLocalidad().PHP_EOL);
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
                    array_push($usuarios, new Usuario($userArray[0], $userArray[1], $userArray[2], $userArray[3], $userArray[4], $userArray[5], $userArray[6], $userArray[7]));
                }
            }
            fclose($archivo);
            if(Usuario::ListaUsuarios($usuarios)){
                $exito = true;
            }
            return $exito;
        }

        private function CargarLista($archivoRecibido="usuarios.csv"):Array{
            $usuarios = array();
            $archivo = fopen($archivoRecibido, "r");            

            while (!feof($archivo)) {
                $linea = fgets($archivo);
                if (!empty($linea)) {
                    $linea = str_replace(PHP_EOL, "", $linea);
                    $userArray = explode(",", $linea);
                    array_push($usuarios, new Usuario($userArray[0], $userArray[1], $userArray[2], $userArray[3], $userArray[4], $userArray[5], $userArray[6], $userArray[7]));
                }
            }
            fclose($archivo);
            return $usuarios;
        }

        public function VerificarUsuario($user):string{
            $respuesta = "";
            if(is_a($user,"Usuario")){
                $lista = $user->CargarLista();

                foreach($lista as $usuario){
                    if($user->getMail()==$usuario->getMail()){
                        if($user->getClave()==$usuario->getClave()){
                            $respuesta = "Verificado";
                            break;
                        }
                        else{
                            $respuesta = "Error en los datos";
                            break;
                        }
                    }
                    else{
                        $respuesta = "Usuario no registrado";
                        break;
                    }
                }
            }
            return $respuesta;
        }

        public static function ExisteUsuario($idUsuario):bool{
            $existe = false;
            $usuarios = Json::LeerJson("Usuarios.json");
            if(is_int($idUsuario)){
                foreach($usuarios as $item){
                    
                    if($item["_id"]==$idUsuario){
                        $existe = true;    
                    }                    
                }
            }  
            return $existe;
        }

    }
?>