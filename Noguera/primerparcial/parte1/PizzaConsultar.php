<?php

include_once "pizza.php";

/*2-
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.. */

if(isset($_POST["sabor"]) && isset($_POST["tipo"])){
    
    echo Pizza::PizzaConsultar($_POST["sabor"], $_POST["tipo"]);

} else {

    echo "Verificar parametros ingresados";
}

?>