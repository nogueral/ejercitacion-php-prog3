<h1>Aplicación No 3 (Obtener el valor del medio)</h1>
<?php 
/*
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
*/

$a = 3;
$b = 4;
$c = 4;

if($c<$b && $a<$c || $c<$a && $b<$c)
{
	echo "Se muestra: ", $c;

} else if($a<$b && $c<$a || $a<$c && $b<$a)
{
	echo "Se muestra: ", $a;
}
else if($b<$c && $a<$b || $b<$a && $c<$b)
{
	echo "Se muestra: ", $b;
}
else
{
	echo "No hay valor en el medio";
}



 ?>
