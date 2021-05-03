<?php
/*PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.*/

include "pizza.php";


if(isset($_GET["sabor"]) && isset($_GET["precio"]) && isset($_GET["tipo"]) && isset($_GET["cantidad"]))
{
    $prod = Pizza::ConstructorParametrizado($_GET["sabor"], $_GET["precio"], $_GET["tipo"], $_GET["cantidad"]);


    echo Pizza::VerificarProducto($prod);


} else 
{
    echo "Error en los parametros ingresados";
}

?>