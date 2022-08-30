<?php

    require_once './modelo/helado.php';

    if(isset($_POST['sabor']) && isset($_POST['tipo'])){
        $sabor = $_POST['sabor'];
        $tipo = $_POST['tipo'];

        echo 'Consultar:'.PHP_EOL;
        echo 'sabor: '.$sabor.' Tipo: '.$tipo.PHP_EOL;

        $obj = Helado::Buscador($sabor, $tipo,'helados.json');

        if($obj){
            echo 'Si Hay'.PHP_EOL;
        }
        else{
            $arrayObj = Helado::ListarObjetos('helados.json');
            $auxTipo = false;
            $auxSabor = false;
            foreach ($arrayObj as $item){
                if($item->getSabor() == $sabor){
                    $auxSabor = true;
                }
                if($item->getTipo() == $tipo){
                    $auxTipo = true;
                }
            }
            if($auxTipo && $auxSabor){
                echo 'No hay sabor: '.$sabor.' tipo: '.$tipo.PHP_EOL;
            }else if($auxSabor && !$auxTipo){
                echo 'No existe el tipo: '.$tipo.PHP_EOL;
            }else if(!$auxSabor && $auxTipo){
                echo 'No existe el sabor: '.$sabor.PHP_EOL;
            }else{
                echo 'No hay sabor: '.$sabor.' ni de tipo: '.$tipo.PHP_EOL;
            }
        }
        
    }
?>