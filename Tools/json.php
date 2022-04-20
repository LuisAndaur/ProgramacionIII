<?php
    
    class Json{

        /**
         * Guarda un archivo con la info.
         *
         * @param array $infoArray El array con la info.
         * @param string $nombreArchivo Nombre del archivo.
         * @return boolean True si el archivo se guardo satisfactoriamente, false caso contrario.
         */
        public static function GuardarJSON($infoArray, $nombreArchivo="Usuarios.json"):bool{
            $exito = false;

            $file = fopen($nombreArchivo, "w");
            if ($file) {
                //var_dump($infoArray);
                $json = json_encode($infoArray, JSON_PRETTY_PRINT);
                echo $json .PHP_EOL;
                fwrite($file, $json);
                $exito = true;
            }     

            fclose($file);
            return $exito;
        }

        /**
         * Leer un archivo con la info.
         *
         * @param string $nombreArchivo Nombre del archivo a leer.
         * @return array El array con la info.
         */
        public static function LeerJson($nombreArchivo="Usuarios.json"):array{
            $info = array();
            
            $archivo = fopen($nombreArchivo, "r");
            if ($archivo) {
                $json = fread($archivo, filesize($nombreArchivo));
                $info = json_decode($json, true);
            }

            fclose($archivo);
            return $info;
        }
    }
    
    
?>
