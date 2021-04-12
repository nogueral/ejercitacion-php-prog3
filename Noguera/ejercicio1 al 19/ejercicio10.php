<h1>Aplicación No 10 (Arrays de Arrays)</h1>
<?php 
/*
LEANDRO NOGUERA

Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
*/


$lapicera[0] = array("color"=>"rojo", "marca"=>"bic", "trazo"=>"grueso", "precio"=>40.57);
$lapicera[1] = array("color"=>"negro", "marca"=>"faber", "trazo"=>"fino", "precio"=>23.82);
$lapicera[2] = array("color"=>"azul", "marca"=>"pepito", "trazo"=>"grueso", "precio"=>70.23);

var_dump($lapicera);

for ($i=0; $i < count($lapicera); $i++) { 
	
	echo "<br/><br/>Se imprime lapicera en posicion: ", $i;

	foreach ($lapicera[$i] as $key => $value) {
	
	print("<br/> Clave: $key - Valor: $value");
	
	}
}



 ?>