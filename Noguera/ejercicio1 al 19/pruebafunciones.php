<?php 
include "ejercicio11.php";
include "ejercicio12.php";
include "ejercicio13.php";
include "ejercicio14.php";

$vec = array(1,2,3,4);

$a = array_map("CalcularPotencia", $vec);

echo "Ejercicio 11: <br/>";
print_r($a);
echo "<br/><br/>";

echo "Ejercicio 12: <br/>";
$b = array('H', 'O', 'L', 'A');

print_r(InvertirPalabra($b));
echo "<br/><br/>";

echo "Ejercicio 13: <br/>";

$palabra = "progRAMACION";
$max = 15;

echo "Valor de retorno: ", ValidarPalabra($palabra, $max);
echo "<br/><br/>";

echo "Ejercicio 14: <br/>";

$numero = 15;

echo "Es par? ", esPar($numero), "<br/>";
echo "Es impar? ", esImpar($numero), "<br/>";


 ?>