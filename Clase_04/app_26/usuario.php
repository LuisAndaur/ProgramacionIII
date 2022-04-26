<?php
    class Usuario{
        public $_id;
        public $_nombre;
        public $_clave;
        public $_mail;
        public $_fechaRegistro;
        public $_img;

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

        function setImg($img){
            if (is_string($img) && !empty($img)) {
                $this->_img = $img;
            }
        }

        function getImg(){
            return $this->_img;
        }

        function __construct($id,$nombre,$clave,$mail,$fechaRegistro,$img){
            $this->setId($id);
            $this->setNombre($nombre);
            $this->setClave($clave);
            $this->setMail($mail);
            $this->setFechaRegistro($fechaRegistro);
            $this->setImg($img);
        }

        public static function AltaUsuario($id,$nombre,$clave,$mail,$fechaRegistro,$img){
            $usuario = null;
            if (is_int($id) && !empty($id) && is_string($nombre) && !empty($nombre) && is_string($clave) && !empty($clave) && is_string($mail) && !empty($mail) && is_string($fechaRegistro) && !empty($fechaRegistro) && is_string($img) && !empty($img)) {
                $usuario = new Usuario($id,$nombre,$clave,$mail,$fechaRegistro,$img);
            }
            return $usuario;
        }

        public static function ListaUsuarios($usuarios=array()):bool{
            $exito = false;
            echo "<ul>";
            foreach ($usuarios as $usuario) {
                echo "<li>".$usuario["_id"]."</li>";
                echo "<li>".$usuario["_nombre"]."</li>";
                echo "<li>".$usuario["_clave"]."</li>";
                echo "<li>".$usuario["_mail"]."</li>";
                echo "<li>".$usuario["_fechaRegistro"]."</li>";
                echo "<li><img src='".$usuario["_img"]."'></li>";
                $exito = true;
            }
            echo "</ul>";
    
            return $exito;
        }

        function GuardarCSV($usuario):bool{
            $exito = false;            

            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $usuario->getNombre().",".$usuario->getClave().",".$usuario->getMail().",".$usuario->getFechaRegistro().",".$usuario->getImg().PHP_EOL);
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
                    array_push($usuarios, new Usuario($userArray[0], $userArray[1], $userArray[2], $userArray[3], $userArray[4], $userArray[5], $userArray[6]));
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
                    array_push($usuarios, new Usuario($userArray[0], $userArray[1], $userArray[2], $userArray[3], $userArray[4], $userArray[5], $userArray[6]));
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