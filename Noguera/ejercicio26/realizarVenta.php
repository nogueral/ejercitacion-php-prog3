<?php
/*Aplicación No 26 (RealizarVenta)

LEANDRO NOGUERA

Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
carga los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases */

include "C:/xampp/htdocs/Noguera/ejercicio25/producto.php";
include "C:/xampp/htdocs/Noguera/ejercicio23/usuario.php";
include "venta.php";

if(isset($_POST["codigoBarra"]) && isset($_POST["id"]) && isset($_POST["cantidadItems"]))
{
    if(Producto::ProductoExistente($_POST["codigoBarra"], $_POST["cantidadItems"]) && Usuario::UsuarioExistente($_POST["id"]))
    {
        $venta = new Venta($_POST["id"], $_POST["cantidadItems"],$_POST["codigoBarra"]);

        if(Venta::Guardar($venta))
        {
            //se descuenta el stock de los productos vendidos
            Producto::ModificarStock($_POST["codigoBarra"], $_POST["cantidadItems"]);
            echo "Venta realizada";

        } else {

            echo "Error al guardar";
        }

    } else {

        echo "No se pudo realizar";
    }

} else {

    echo "Error de parametros";
}


?>