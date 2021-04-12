<h1>Aplicación No 8 (Carga aleatoria)</h1>

<?php 
/*
LEANDRO NOGUERA
Aplicación No 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';
*/

$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';

var_dump($v);

foreach ($v as $key => $value) {
	
	print("<br/> Clave: $key - Valor: $value");
}

 ?>