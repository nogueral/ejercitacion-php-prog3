<?php

include "pizza.php";

/*
LEANDRO NOGUERA

5- (2 pts.)PizzaCarga.php:.(continuación) Cambio de get a post.
completar el alta con imagen de la pizza, guardando la imagen con el tipo y el sabor como nombre en la carpeta
/ImagenesDePizzas. */

if(isset($_POST["sabor"]) && isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && $_FILES["imagen"]["error"] == 0)
{
    $prod = Pizza::ConstructorParametrizado($_POST["sabor"], $_POST["precio"], $_POST["tipo"], $_POST["cantidad"]);

    $retorno = Pizza::VerificarProducto($prod);

    if($retorno == "Ingresado"){

        Pizza::GuardarImagen();
    }
    
    echo $retorno;


} else 
{
    echo "Error en los parametros ingresados";
}



?>