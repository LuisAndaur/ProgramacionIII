<?php
include_once('productoSql.php');
    class Producto{
        public $id;
        public $nombre;
        public $codigo;
        public $tipo;
        public $stock;
        public $precio;
        public $fecha_de_registro;

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

        function setCodigo($codigo){
            if (is_string($codigo) && !empty($codigo) && strlen($codigo)) {
                $this->codigo = $codigo;
            }
        }

        function getCodigo(){
            return $this->codigo;
        }

        function setTipo($tipo){
            if (is_string($tipo) && !empty($tipo)) {
                $this->tipo = $tipo;
            }
        }

        function getTipo(){
            return $this->tipo;
        }

        function setStock($stock){
            if (is_int($stock) && !empty($stock) && $stock>-1) {
                $this->stock = $stock;
            }
        }

        function getStock(){
            return $this->stock;
        }

        function setPrecio($precio){
            if (is_double($precio) && !empty($precio) && $precio>0) {
                $this->precio = $precio;
            }
        }

        function getPrecio(){
            return $this->precio;
        }

        function setFechaDeRegistro($fecha_de_registro){
            if (is_string($fecha_de_registro) && !empty($fecha_de_registro)) {
                $this->fecha_de_registro = $fecha_de_registro;
            }
        }

        function getFechaDeRegistro(){
            return $this->fecha_de_registro;
        }

        function construct(){

        }

        public static function Crearproducto($id=0,$codigo,$nombre,$tipo,$stock,$precio,$fecha_de_registro){
            $producto = new Producto();
            $producto->setId($id);
            $producto->setNombre($nombre);
            $producto->setCodigo($codigo);
            $producto->setTipo($tipo);
            $producto->setStock($stock);
            $producto->setPrecio($precio);
            $producto->setFechaDeRegistro($fecha_de_registro);
            return $producto;
        }

        public static function AltaProducto($codigo,$nombre,$tipo,$stock,$precio,$fecha_de_registro){
            $producto = null;
            if (is_string($nombre) && !empty($nombre) && is_string($codigo) && !empty($codigo) && strlen($codigo) && is_string($tipo) && !empty($tipo) && is_int($stock) && !empty($stock) && $stock>0 && is_double($precio) && !empty($precio) && $precio>0) {
                $producto = Producto::Crearproducto(0,$codigo,$nombre,$tipo,$stock,$precio,$fecha_de_registro);
                ProductoSql::insertarProducto($producto);
            }
            return $producto;
        }

        public static function ListaProductos($productos=array()):bool{
            $exito = false;
            echo "<ul>";
            foreach ($productos as $producto) {
                echo "<li>".$producto["id"]."</li>";                
                echo "<li>".$producto["codigo"]."</li>";
                echo "<li>".$producto["nombre"]."</li>";
                echo "<li>".$producto["tipo"]."</li>";
                echo "<li>".$producto["stock"]."</li>";
                echo "<li>".$producto["precio"]."</li>";
                $exito = true;
            }
            echo "</ul>";
    
            return $exito;
        }

        function GuardarCSV($producto):bool{
            $exito = false;            

            $archivo = fopen("productos.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $producto->getCodigo().",".$producto->getNombre().",".$producto->getTipo().",".$producto->getStock().",".$producto->getPrecio().PHP_EOL);
                $exito = true;
            }
            fclose($archivo);

            return $exito;
        }

        static function LeerCsv($archivoRecibido="productos.csv"):bool{
            $exito = false;
            $archivo = fopen($archivoRecibido, "r");
            $productos = array();

            while (!feof($archivo)) {
                $linea = fgets($archivo);
                if (!empty($linea)) {
                    $linea = str_replace(PHP_EOL, "", $linea);
                    $userArray = explode(",", $linea);
                    array_push($productos, new Producto($userArray[0], $userArray[1], $userArray[2], $userArray[3], $userArray[4], $userArray[5], $userArray[6]));
                }
            }

            fclose($archivo);
            if(Producto::Listaproductos($productos)){
                $exito = true;
            }

            return $exito;
        }

        private function CargarLista($archivoRecibido="productos.csv"):Array{
            $productos = array();
            $archivo = fopen($archivoRecibido, "r");            

            while (!feof($archivo)) {
                $linea = fgets($archivo);
                if (!empty($linea)) {
                    $linea = str_replace(PHP_EOL, "", $linea);
                    $userArray = explode(",", $linea);
                    array_push($productos, new Producto($userArray[0], $userArray[1], $userArray[2], $userArray[3], $userArray[4], $userArray[5], $userArray[6]));
                }
            }

            fclose($archivo);
            return $productos;
        }

        public function VerificarProducto($producto):string{
            $respuesta = "";
            $productos = Json::LeerJson("Productos.json");
            if(is_a($producto,"Producto")){
                foreach($productos as $index => $item){
                    
                    if($item["codigo"]==$producto->getCodigo()){
                        $num1 = $item["stock"];
                        $num2 = $producto->getStock();
                        $nuevoStock = $num1 += $num2;
                        $productos[$index]["stock"] = $nuevoStock;

                        Json::GuardarJson($productos,"Productos.json");
                        $respuesta = "Actualizado".PHP_EOL;
                        return $respuesta;    
                    }                    
                }

                array_push($productos,$producto);
                Json::GuardarJson($productos,"Productos.json");
                $respuesta = "Ingresado".PHP_EOL;
                return $respuesta;

            }
            else{
                $respuesta = "No se pudo hacer".PHP_EOL;
            }           
            return $respuesta;
        }

        public static function descontarStock($codProducto, $cantidad){
            $productos = Json::LeerJson("Productos.json");
            foreach($productos as $index => $item){
                
                if($item["codigo"]==$codProducto){
                    $num1 = $item["stock"];
                    $num2 = $cantidad;
                    $nuevoStock = $num1 -= $num2;
                    $productos[$index]["stock"] = $nuevoStock;

                    Json::GuardarJson($productos,"Productos.json");   
                }                    
            }
        }

        public static function ExisteProducto($codProducto):bool{
            $existe = false;
            $productos = Json::LeerJson("Productos.json");
            if(is_string($codProducto)){
                foreach($productos as $item){
                    if($item["codigo"]==$codProducto){
                        $existe = true;    
                    }                    
                }
            }  
            return $existe;
        }


        public static function HayStock($codProducto, $cantidad):bool{
            $stock = false;
            $productos = Json::LeerJson("Productos.json");
            if(is_string($codProducto)){
                foreach($productos as $item){
                    if($item["stock"]>=$cantidad){
                        $stock = true;
                    }                    
                }
            }  
            return $stock;
        }

    }
?>