<?php
/*Aplicación No 33 ( ModificacionProducto BD)

LEANDRO NOGUERA 

Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase */

include "./producto.php";


if(isset($_POST["codigoBarra"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"]))
{
    $prod = Producto::ConstructorParametrizado($_POST["codigoBarra"],$_POST["nombre"],$_POST["tipo"],$_POST["stock"],$_POST["precio"]);


    echo Producto::VerificarProductoDB($prod);


} else 
{
    echo "Error en los parametros ingresados";
}




?>
