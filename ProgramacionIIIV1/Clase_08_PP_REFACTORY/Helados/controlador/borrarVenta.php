<?php

    require_once('./datos/ventaSql.php');
    require_once('./modelo/venta.php');

    $_DELETE = array();
    $_DELETE = json_decode(file_get_contents('php://input'), true);

    $nro_pedido = $_DELETE['numeroPedido'];
    $venta = VentaSql::LeerPedido($nro_pedido);
    if($venta){
        copy("ImagenesDeLaVenta/" . $venta->getImagen(), "BACKUPVENTAS/" . $venta->getImagen());
        unlink("ImagenesDeLaVenta/" . $venta->getImagen());
        VentaSql::BorrarVenta($nro_pedido);
    }
    else{
        echo "La venta no existe";
    }

?>