<?php

    require_once './modelo/hamburguesa.php';

    if(isset($_POST['nombre']) && isset($_POST['tipo'])){
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];


        echo 'Hamburguesa a consultar:'.PHP_EOL;
        echo 'Nombre: '.$nombre.' Tipo: '.$tipo.PHP_EOL;

        $hamburguesa = Hamburguesa::Buscador($nombre, $tipo);

        if($hamburguesa){
            echo 'Si Hay'.PHP_EOL;
        }
        else{
            $hamburguesas = Hamburguesa::LeerHamburguesas();
            $auxTipo = false;
            $auxNombre = false;
            foreach ($hamburguesas as $hamburguesa){
                if($hamburguesa->getNombre() == $nombre){
                    $auxNombre = true;
                }
                if($hamburguesa->getTipo() == $tipo){
                    $auxTipo = true;
                }
            }
            if($auxTipo && $auxNombre){
                echo 'No hay hamburguesas '.$nombre.' tipo '.$tipo.PHP_EOL;
            }else if($auxNombre && !$auxTipo){
                echo 'No existe el tipo: '.$tipo.PHP_EOL;
            }else if(!$auxNombre && $auxTipo){
                echo 'No existe el nombre: '.$nombre.PHP_EOL;
            }else{
                echo 'No hay hamburguesas '.$nombre.' ni de tipo '.$tipo.PHP_EOL;
            }
        }
        
    }
?>