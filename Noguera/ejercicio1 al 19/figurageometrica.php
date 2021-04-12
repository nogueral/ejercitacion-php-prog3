<?php 

abstract class FiguraGeometrica
{
	protected $_color;
	protected $_perimetro;
	protected $_superficie;

	function __construct()
	{

	}

	function GetColor() : string
	{
		return $this->_color;
	}

	function SetColor($color)
	{
		$this->_color = $color;
	}

	abstract function Dibujar();

	abstract protected function CalcularDatos();

	function ToString()
	{
		echo "Superficie: ", $this->_superficie, "<br/>";
		echo "Permietro: ", $this->_perimetro, "<br/>";
		echo "Color: ", $this->_color, "<br/>";
		echo "<br/>";

		$this->Dibujar();
	}
}

 ?>