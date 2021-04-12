<?php 
include_once "figurageometrica.php";

class Triangulo extends FiguraGeometrica
{
	private $altura;
	private $base;

	function __construct($b, $h)
	{
		$this->altura = $h;
		$this->base = $b;
		$this->CalcularDatos();
	}

	protected function CalcularDatos()
	{
		$this->_superficie = ($this->base * $this->altura) / 2;
		$this->_perimetro = ($this->altura * 2) + $this->base;
	}

	function Dibujar()
	{
		
		for ($i=0; $i < $this->altura; $i++) 
		{ 
			echo str_repeat("*", $i+1);
			echo "<br/>";
		}
		
 
	}
}

 ?>