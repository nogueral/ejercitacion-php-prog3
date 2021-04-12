<?php
/*Aplicación No 25 ( AltaProducto)

LEANDRO NOGUERA

Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase */

include "producto.php";


if(isset($_POST["codigoBarra"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"]))
{
    $prod = new Producto($_POST["codigoBarra"], $_POST["nombre"], $_POST["tipo"], $_POST["stock"], $_POST["precio"]);

    /*if(Producto::Guardar($prod, "a"))
    {
        echo "Guardado con exito";

    } else 
    {
        echo "No se ha podido cargar producto";
    }*/

    echo Producto::VerificarProducto($prod);


} else 
{
    echo "Error en los parametros ingresados";
}


?>