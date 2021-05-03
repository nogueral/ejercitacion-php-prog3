  
<?php
/*
LEANDRO NOGUERA
3-
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .

b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.*/

include_once "./venta.php";
include_once "./pizza.php";

if(isset($_POST["usuario"]) && isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && $_FILES["imagen"]["error"] == 0)
{
    if(Pizza::VerificarPedido($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"]))
    {

        $destino = Venta::GuardarImagen();

        $venta = Venta::ConstructorParametrizado($_POST["usuario"], $_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $destino);

        echo "ID Venta: " . $venta->InsertarVentaParametros() . "<br/>";
        echo "Venta cargada con exito";

    } else {

        echo "No se pudo realizar";
    }

} else {

    echo "Error de parametros";
}



?>