<?php

    require_once './modelo/helado.php';

    if(isset($_POST['sabor']) && isset($_POST['tipo'])){
        $sabor = $_POST['sabor'];
        $tipo = $_POST['tipo'];

        echo 'Helado a consultar:'.PHP_EOL;
        echo 'sabor: '.$sabor.' Tipo: '.$tipo.PHP_EOL;

        $helado = Helado::Buscador($sabor, $tipo);

        if($helado){
            echo 'Si Hay'.PHP_EOL;
        }
        else{
            $helados = Helado::LeerHelados();
            $auxTipo = false;
            $auxSabor = false;
            foreach ($helados as $helado){
                if($helado->getSabor() == $sabor){
                    $auxSabor = true;
                }
                if($helado->getTipo() == $tipo){
                    $auxTipo = true;
                }
            }
            if($auxTipo && $auxSabor){
                echo 'No hay helados '.$sabor.' tipo '.$tipo.PHP_EOL;
            }else if($auxSabor && !$auxTipo){
                echo 'No existe el tipo: '.$tipo.PHP_EOL;
            }else if(!$auxSabor && $auxTipo){
                echo 'No existe el sabor: '.$sabor.PHP_EOL;
            }else{
                echo 'No hay helados '.$sabor.' ni de tipo '.$tipo.PHP_EOL;
            }
        }
        
    }
?>