<?php
    class Producto{
        public $_id;
        public $_nombre;
        public $_codigo;
        public $_tipo;
        public $_stock;
        public $_precio;

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

        function setCodigo($codigo){
            if (is_string($codigo) && !empty($codigo) && strlen($codigo)) {
                $this->_codigo = $codigo;
            }
        }

        function getCodigo(){
            return $this->_codigo;
        }

        function setTipo($tipo){
            if (is_string($tipo) && !empty($tipo)) {
                $this->_tipo = $tipo;
            }
        }

        function getTipo(){
            return $this->_tipo;
        }

        function setStock($stock){
            if (is_int($stock) && !empty($stock) && $stock>-1) {
                $this->_stock = $stock;
            }
        }

        function getStock(){
            return $this->_stock;
        }

        function setPrecio($precio){
            if (is_double($precio) && !empty($precio) && $precio>0) {
                $this->_precio = $precio;
            }
        }

        function getPrecio(){
            return $this->_precio;
        }

        function __construct($id,$nombre,$codigo,$tipo,$stock,$precio){
            $this->setId($id);
            $this->setNombre($nombre);
            $this->setCodigo($codigo);
            $this->setTipo($tipo);
            $this->setStock($stock);
            $this->setPrecio($precio);
        }

        public static function AltaProducto($id,$nombre,$codigo,$tipo,$stock,$precio){
            $producto = null;
            if (is_int($id) && !empty($id) && is_string($nombre) && !empty($nombre) && is_string($codigo) && !empty($codigo) && strlen($codigo) && is_string($tipo) && !empty($tipo) && is_int($stock) && !empty($stock) && $stock>0 && is_double($precio) && !empty($precio) && $precio>0) {
                $producto = new Producto($id,$nombre,$codigo,$tipo,$stock,$precio);
            }
            return $producto;
        }

        public static function ListaProductos($productos=array()):bool{
            $exito = false;
            echo "<ul>";
            foreach ($productos as $producto) {
                echo "<li>".$producto["_id"]."</li>";
                echo "<li>".$producto["_nombre"]."</li>";
                echo "<li>".$producto["_codigo"]."</li>";
                echo "<li>".$producto["_tipo"]."</li>";
                echo "<li>".$producto["_stock"]."</li>";
                echo "<li>".$producto["_precio"]."</li>";
                $exito = true;
            }
            echo "</ul>";
    
            return $exito;
        }

        function GuardarCSV($producto):bool{
            $exito = false;            

            $archivo = fopen("productos.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $producto->getNombre().",".$producto->getCodigo().",".$producto->getTipo().",".$producto->getStock().",".$producto->getPrecio().PHP_EOL);
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
                    
                    if($item["_codigo"]==$producto->getCodigo()){
                        $num1 = $item["_stock"];
                        $num2 = $producto->getStock();
                        $nuevoStock = $num1 += $num2;
                        $productos[$index]["_stock"] = $nuevoStock;

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
                
                if($item["_codigo"]==$codProducto){
                    $num1 = $item["_stock"];
                    $num2 = $cantidad;
                    $nuevoStock = $num1 -= $num2;
                    $productos[$index]["_stock"] = $nuevoStock;

                    Json::GuardarJson($productos,"Productos.json");   
                }                    
            }
        }

        public static function ExisteProducto($codProducto):bool{
            $existe = false;
            $productos = Json::LeerJson("Productos.json");
            if(is_string($codProducto)){
                foreach($productos as $item){
                    if($item["_codigo"]==$codProducto){
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
                    if($item["_stock"]>=$cantidad){
                        $stock = true;
                    }                    
                }
            }  
            return $stock;
        }

    }
?>