<?php
    include_once('./modelo/devoluciones.php');
    require_once('./datos/ventaSql.php');
    require_once('./modelo/venta.php');
    require_once('./modelo/cupon.php');

    $carpeta = "Devoluciones";
    if(!is_dir($carpeta)){
        mkdir($carpeta,0777,true);
        echo "Carpeta ".$carpeta." creada";
    }

    if(isset($_POST['causa']) && isset($_POST['nroPedido'])){
        $nro_pedido = (int)$_POST['nroPedido'];
        $venta = VentaSql::LeerPedido($nro_pedido);
        if($venta){
            $path = explode(".",$_FILES["archivo"]["name"]);
            $filename = 'devolucion'.$nro_pedido;
            $separador = ".";
            $extension = $path[1];
            $imagen = $filename.$separador.$extension;

            $destinoOriginal = $carpeta."/".$filename.$separador.$extension;
            move_uploaded_file($_FILES["archivo"]["tmp_name"],$destinoOriginal);

            $causa = $_POST['causa'];
            $devolucion = Devolucion::AltaDevolucion(rand(1,1000),$nro_pedido,$causa,$imagen);
            Devolucion::guardarDevolucion($devolucion);
            $cupon = Cupon::AltaCupon(rand(200,10000),$devolucion->getId(),10);
            echo $cupon->getDescuento();
            Cupon::guardarCupon($cupon);
            copy("ImagenesDeLaVenta/" . $venta->getImagen(), "BACKUPVENTAS/" . $venta->getImagen());
            unlink("ImagenesDeLaVenta/" . $venta->getImagen());
            VentaSql::BorrarVenta($nro_pedido);
        }
        else{
            echo "La venta no existe";
        }
    }






?>