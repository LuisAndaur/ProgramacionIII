<?php

    require_once './datos/ventaSql.php';
    require_once './modelo/venta.php';

    $_PUT = array();
    $_PUT = json_decode(file_get_contents('php://input'), true);

    $nro_pedido = $_PUT['numeroPedido'];
    $usuario = $_PUT['usuario'];
    $sabor = $_PUT['sabor'];
    $tipo = $_PUT['tipo'];
    $cantidad = $_PUT['cantidad'];

    $venta = VentaSql::LeerPedido($nro_pedido);

    if($venta){
        if(($tipo == 'agua' || $tipo == 'crema') && $cantidad > 0){
            VentaSql::ModificarVenta($nro_pedido, $usuario, $sabor, $tipo, $cantidad);
        }
        else{
            echo "Error al recibir los parametros";
        }
    }
    else{
        echo "El helado no existe";
    }




?>