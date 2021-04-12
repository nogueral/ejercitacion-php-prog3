<?php 
include_once "rectangulo.php";
include_once "triangulo.php";

/*
Aplicación Nº 15 (Figuras geométricas)
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color, un método virtual (ToString) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
Ejemplo:
  * 		*******
 *** 		*******
***** 		*******
Utilizar el método ToString para obtener toda la información completa del objeto, y luego
dibujarlo por pantalla.
*/


$rec = new Rectangulo(50, 10);

$rec->SetColor("blue");


$rec->ToString();

echo "<br/>";



$tr = new triangulo(20, 10);

$tr->SetColor("red");

$tr->ToString();



 ?>