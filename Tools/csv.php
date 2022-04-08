<?php

    //----- GUARDAR - ESCRIBIR -----
    /**
     * Guarda un archivo con info.
     * @return boolean True si el archivo se guardo correctamente, false en caso contrario.
     */
    function GuardarCSV():bool{
        $success = false;
        try {
            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $this->getName().",".$this->getPassword().",".$this->getEmail().PHP_EOL);
                $success = true;
            }
        } catch (\Throwable $th) {
            echo "Error al guardar el archivo";
        }finally{
            fclose($archivo);
        }

        return $success;
    }


    //----- LEER -----

    /**
     * Lee un archivo con info.
     * @return array El array con info.
     */
    static function Leer($filename="usuarios.csv"):bool{
        $file = fopen($filename, "r");
        $users = array();
        try {
            while (!feof($file)) {
                $line = fgets($file);
                if (!empty($line)) {
                    $line = str_replace(PHP_EOL, "", $line);
                    $userArray = explode(",", $line);
                    array_push($users, new Usuario($userArray[0], $userArray[1], $userArray[2]));
                }
            }
        } catch (\Throwable $th) {
            echo "Error while reading the file";
        }finally{
            fclose($file);
            return Usuario::ListUsers($users);
        }
    }


    public static function LeerCSV($fileName='autos2.csv'): array{
        $arrayAutos = array();
        $file = fopen($fileName, 'r'); //TextIOWrapper
        while (!feof($file)) {
            $line = fgets($file);
            if (!empty($line)) {
                $line = str_replace(PHP_EOL, '', $line);
                $arrayAuto = explode(';', $line);
                $auto = new Auto($arrayAuto[0], $arrayAuto[1], $arrayAuto[2], $arrayAuto[3]);
                array_push($arrayAutos, $auto);
            }
        }
        fclose($file);

        return $arrayAutos;
    }



    /**
     * Load a garage from a CSV file.
    *
    * @param String $file The file to load the garage from.
    */
    public static function CSVtoGarage($file="Garage2.csv"): Garage{
        $counter = 0;
            $file = fopen($file, "r");
            while (!feof($file)) {
            $line = fgets($file);
            if (!empty($line)){
                $line = str_replace(PHP_EOL, '', $line);
                $data = explode(',', $line);
                if($counter == 0){
                    $garage = new Garage($data[0], $data[1]);
                }else{
                    $auto = new Auto($data[0], $data[1], $data[2], $data[3]);
                    $garage->Add($auto);
                }
                $counter++;
            }
        }         
            fclose($file);
    
            return $garage;
        }

?>