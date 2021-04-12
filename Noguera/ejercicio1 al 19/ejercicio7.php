<h1>Aplicación No 7 (Mostrar impares)</h1>

<?php 
/*
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach.
*/

$vec;
$num;
$contador = 0;

for ($i=0; $contador < 10; $i++) { 
	
	$num = random_int(1, 100);

	if($num%2!=0)
	{
		$vec[$contador] = $num;
		$contador++;
	}
}

var_dump($vec);

echo "<br/>Imprimo con for: <br/>";

for ($i=0; $i < $contador; $i++) 
{ 
	echo "<br/>", $vec[$i];
}

echo "<br/>Imprimo con while: <br/>";
$contador = 0;

while ($contador < count($vec)) {
	
	echo "<br/>", $vec[$contador];
	$contador++;
}

echo "<br/>Imprimo con foreach: <br/>";
foreach ($vec as $valor) {
	
	echo "<br/>", $valor;
}

 ?>