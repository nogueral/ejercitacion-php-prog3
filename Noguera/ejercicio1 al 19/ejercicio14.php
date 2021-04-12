
<?php
/*
Aplicación Nº 14 (Par e impar)
Crear una función llamada esPar que reciba un valor entero como parámetro y devuelva TRUE
si este número es par ó FALSE si es impar.
Reutilizando el código anterior, crear la función esImpar

*/

function esPar($x)
{
	$retorno = false;

	if($x % 2 == 0)
	{
		$retorno = true;
	}

	return $retorno;
}

function esImpar($x)
{
	$retorno = false;

	if(esPar($x) == false)
	{
		$retorno = true;
	}

	return $retorno;
}



?>