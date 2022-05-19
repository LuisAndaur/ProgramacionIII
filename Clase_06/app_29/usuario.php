<?php
    include_once("usuarioSql.php");
    class Usuario{
        public $id;
        public $nombre;
        public $apellido;
        public $clave;
        public $mail;
        public $fecha_de_registro;
        public $localidad;

        function setId($id){
            if (is_int($id) && !empty($id)) {
                $this->id = $id;
            }
        }

        public function getId(){
            return $this->id;
        }

        function setNombre($nombre){
            if (is_string($nombre) && !empty($nombre)) {
                $this->nombre = $nombre;
            }
        }

        function getNombre(){
            return $this->nombre;
        }

        function setApellido($apellido){
            if (is_string($apellido) && !empty($apellido)) {
                $this->apellido = $apellido;
            }
        }

        function getApellido(){
            return $this->apellido;
        }

        function setClave($clave){
            if (is_string($clave) && !empty($clave)) {
                $this->clave = $clave;
            }
        }

        function getClave(){
            return $this->clave;
        }

        function setMail($mail){
            if (is_string($mail) && !empty($mail)) {
                $this->mail = $mail;
            }
        }

        function getMail(){
            return $this->mail;
        }

        function setFechaDeRegistro($fecha_de_registro){
            if (is_string($fecha_de_registro) && !empty($fecha_de_registro)) {
                $this->fecha_de_registro = $fecha_de_registro;
            }
        }

        function getFechaDeRegistro(){
            return $this->fecha_de_registro;
        }

        function setLocalidad($localidad){
            if (is_string($localidad) && !empty($localidad)) {
                $this->localidad = $localidad;
            }
        }

        function getLocalidad(){
            return $this->localidad;
        }

        // function construct($id,$nombre,$apellido,$clave,$mail,$fecha_de_registro,$localidad){
        //     $this->setId($id);
        //     $this->setNombre($nombre);
        //     $this->setApellido($apellido);
        //     $this->setClave($clave);
        //     $this->setMail($mail);
        //     $this->setfecha_de_registro($fecha_de_registro);
        //     $this->setlocalidad($localidad);
        // }

        function construct(){

        }

        public static function CrearUsuario($id,$nombre,$apellido,$clave,$mail,$fecha_de_registro,$localidad){
            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setNombre($nombre);
            $usuario->setApellido($apellido);
            $usuario->setClave($clave);
            $usuario->setMail($mail);
            $usuario->setFechaDeRegistro($fecha_de_registro);
            $usuario->setLocalidad($localidad);
            return $usuario;
        }

        public static function AltaUsuario($nombre,$apellido,$clave,$mail,$fecha_de_registro,$localidad):bool{
            $respuesta = false;
            $id = 0;
            if (is_string($nombre) && !empty($nombre)&& is_string($apellido) && !empty($apellido) && is_string($clave) && !empty($clave) && is_string($mail) && !empty($mail) && is_string($fecha_de_registro) && !empty($fecha_de_registro) && is_string($localidad) && !empty($localidad)) {
                $usuario = new Usuario($id,$nombre,$apellido,$clave,$mail,$fecha_de_registro,$localidad);
                $ultimoId = usuarioSql::insertarUsuario($usuario);
                if ($usuario!=null && $ultimoId>0) {
                    $respuesta = true;
                }
            }
            return $respuesta;
        }

        public static function ListaUsuarios($usuarios=array()):bool{
            $exito = false;
            $usuariosSql = array();
            $usuariosSql = UsuarioSql::getAllUsuarios();
            //vardump($usuariosSql).PHPEOL;
            if ($usuarios == array()) {
                echo "<ul>";
                foreach ($usuariosSql as $item) {
                    $usuario = Usuario::CrearUsuario($item["id"],$item["nombre"],$item["apellido"],$item["clave"],$item["mail"],$item["fechaderegistro"],$item["localidad"]);
                    echo "<li>".$usuario->getId()."</li>";
                    echo "<li>".$usuario->getNombre()."</li>";
                    echo "<li>".$usuario->getApellido()."</li>";
                    echo "<li>".$usuario->getClave()."</li>";
                    echo "<li>".$usuario->getMail()."</li>";
                    echo "<li>".$usuario->getFechaDeRegistro()."</li>";
                    echo "<li>".$usuario->getLocalidad()."</li>";
                }
                echo "</ul>";
                $exito = true;
            }
            else{
                echo "<ul>";
                foreach ($usuarios as $item) {
                    $usuario = Usuario::CrearUsuario($item["id"],$item["nombre"],$item["apellido"],$item["clave"],$item["mail"],$item["fechaderegistro"],$item["localidad"]);
                    echo "<li>".$usuario->getId()."</li>";
                    echo "<li>".$usuario->getNombre()."</li>";
                    echo "<li>".$usuario->getApellido()."</li>";
                    echo "<li>".$usuario->getClave()."</li>";
                    echo "<li>".$usuario->getMail()."</li>";
                    echo "<li>".$usuario->getFechaDeRegistro()."</li>";
                    echo "<li>".$usuario->getLocalidad()."</li>";
                }
                echo "</ul>";
                $exito = true;
            }
            
            return $exito;
        }

        function GuardarCSV($usuario):bool{
            $exito = false;            

            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $usuario->getNombre().",".$usuario->getApellido().",".$usuario->getClave().",".$usuario->getMail().",".$usuario->getFechaDeRegistro().",".$usuario->getLocalidad().PHP_EOL);
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

        public static function VerificarUsuarioSql($clave,$mail):string{
            $respuesta = "Error en los datos";
            if(!empty($clave) && !empty($mail)){
                $usuario = UsuarioSql::VerificarUsuario($clave,$mail);
                if($usuario){
                    if(($usuario->getId()!=null && $usuario->getId()>0)){
                        $respuesta = "Verificado"; 
                    }
                    $respuesta = "Verificado"; 
                }
                else{
                    $respuesta = "Usuario no registrado";
                }
            }
            return $respuesta;
        }

        public static function ExisteUsuario($idUsuario):bool{
            $existe = false;
            $usuarios = Json::LeerJson("Usuarios.json");
            if(is_int($idUsuario)){
                foreach($usuarios as $item){
                    
                    if($item["id"]==$idUsuario){
                        $existe = true;    
                    }                    
                }
            }  
            return $existe;
        }

    }
?>