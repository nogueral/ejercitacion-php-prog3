
<style>
table, td, tr{
    border: 1px solid black;
    border-collapse: collapse;
}
</style>


<?php
/*
LEANDRO NOGUERA

A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
alfabéticamente de forma ascendente o descendente.
B. Obtener los detalles completos de todos los productos y poder ordenarlos
alfabéticamente de forma ascendente y descendente.
C. Obtener todas las compras filtradas entre dos cantidades.
D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.
E. Mostrar los primeros “N” números de productos que se han enviado.
F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
G. Indicar el monto (cantidad * precio) por cada una de las ventas.
H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario
(ejemplo: 104).
I. Obtener todos los números de los productos vendidos por algún usuario filtrado por
localidad (ejemplo: ‘Avellaneda’).
J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o
apellido.
K. Mostrar las ventas entre dos fechas del año. */

include_once "./usuario.php";
include_once "./producto.php";
include_once "./venta.php";

// A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
// alfabéticamente de forma ascendente o descendente.

$vec = Usuario::TraerTodosLosUsuariosOrdenados($_GET["order"]);
Usuario::TablaUsuarioConParametro($vec);

// B. Obtener los detalles completos de todos los productos y poder ordenarlos
// alfabéticamente de forma ascendente y descendente.

// $vec = Producto::TraerTodosLosProductosOrdenados($_GET["order"]);
// Producto::TablaProductoConParametro($vec);

//C. Obtener todas las compras filtradas entre dos cantidades.

// $vec = Venta::TraerVentasPorCantidades($_GET["min"],$_GET["max"]);
// Venta::ImprimirVentasConParametro($vec);

// D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.

// $vec = Venta::TotalProductosVendidos($_GET["fechaMin"], $_GET["fechaMax"]);

// foreach($vec as $item){

//      echo "Cantidad productos vendidos: " . $item;
    
// }

 //E. Mostrar los primeros “N” números de productos que se han enviado.

//  Venta::MostrarProductosParcial($_GET["max"]);

 //F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.

//  $lista = Venta::ListadoUsuarioYProducto();
//  Venta::ImprimirVentasConParametro($lista);

//G. Indicar el monto (cantidad * precio) por cada una de las ventas.

//$lista = Venta::MontoVentaPorUnidad();
//Venta::ImprimirVentasConParametro($lista);

//H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario (ejemplo: 104).

// $lista = Venta::CantidadTotalPorUsuario($_GET["id_producto"],$_GET["id_usuario"]);
// var_dump(($lista));

//I. Obtener todos los números de los productos vendidos por algún usuario filtrado por localidad (ejemplo: ‘Avellaneda’).

// $lista = Venta::ProductosPorLocalidad($_GET["localidad"]);
// var_dump(($lista));

//J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o apellido.

// $lista = Usuario::FiltrarUsuariosPorNombre($_GET["letra"]);
// Usuario::ImprimirUsuariosConParametro($lista);

 //K. Mostrar las ventas entre dos fechas del año.

// $lista = Venta::VentasEntreDosFechas($_GET["fechaMin"], $_GET["fechaMax"]);
// Venta::TablaVentasConParametro($lista);

?>