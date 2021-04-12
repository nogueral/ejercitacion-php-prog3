<h1>Aplicación No 1 (Sumar números)</h1>


<?php

/*
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
*/

$contador = 0;

for ($i=0; $i < 1000; $i++) { 
	echo " / ", $i+1;
	$contador++;
}

echo "<br/> Cantidad de nros sumados: ", $contador;

?>