<?php

include_once "./venta.php";
/*
LEANDRO NOGUERA

4- (3 pts.)ConsultasVentas.php: necesito saber :
a- la cantidad de pizzas vendidas
b- el listado de ventas entre dos fechas ordenado por sabor.
c- el listado de ventas de un usuario ingresado
d- el listado de ventas de un sabor ingresado */

echo "a- la cantidad de pizzas vendidas: ";
echo "<br/>";

$vec = Venta::CantidadPizzasVendidas();
Venta::ImprimirVentasConParametro($vec);

echo "<br/>";
echo "b- el listado de ventas entre dos fechas ordenado por sabor.";
echo "<br/>";

$vec = Venta::VentasEntreDosFechas("2042-02-13", "2042-02-13");

Venta::ImprimirVentasConParametro($vec);

echo "<br/>";
echo "c- el listado de ventas de un usuario ingresado";
echo "<br/>";

$vec = Venta::VentasPorUsuario("leandrodnog@gmail.com");
Venta::ImprimirVentasConParametro($vec);

echo "<br/>";
echo "d- el listado de ventas de un sabor ingresado";
echo "<br/>";

$vec = Venta::VentasPorSabor("roquefort");
Venta::ImprimirVentasConParametro($vec);

?>