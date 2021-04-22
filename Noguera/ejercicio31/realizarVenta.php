<?php
/*Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases */

include_once "./venta.php";
include_once "./usuario.php";
include_once "./producto.php";

if(isset($_POST["codigoBarra"]) && isset($_POST["id"]) && isset($_POST["cantidadItems"]))
{
    if(Producto::ProductoExistenteBD($_POST["codigoBarra"], $_POST["cantidadItems"]) && Usuario::UsuarioExistenteBD($_POST["id"]))
    {
        $venta = Venta::ConstructorParametrizado($_POST["id"], $_POST["cantidadItems"], $_POST["codigoBarra"]);

        $retorno = $venta->InsertarVentaParametros();

        //se descuenta el stock de los productos vendidos
        Producto::ModificarStockBD($_POST["codigoBarra"], $_POST["cantidadItems"]);
        echo "Venta realizada - " . "ID Venta Nro.: " . $retorno;

    } else {

        echo "No se pudo realizar";
    }

} else {

    echo "Error de parametros";
}



?>