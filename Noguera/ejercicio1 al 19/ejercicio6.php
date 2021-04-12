
<h1>Aplicación No 6 (Carga aleatoria)</h1>
<?php 
/*
LEANDRO NOGUERA

Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.
*/
$vec = array(rand(1,12), rand(1,12), rand(1,12), rand(1,12), rand(1,12));
$suma = array_sum($vec);

var_dump($vec);

$prom = $suma / count($vec);

if($prom < 6)
{
	echo "<br/>El promedio es menor a 6";
} 
else if($prom > 6)
{
	echo "<br/>El promedio es mayor a 6";
} 
else
{
	echo "<br/>El promedio es igual a 6";
}

 ?>