<?php
/*Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave */

include_once "./usuario.php";

if(isset($_POST["claveNueva"]) && isset($_POST["clave"]) && isset($_POST["mail"]) && isset($_POST["nombre"])){

    $user = Usuario::ConstructorParametrizado($_POST["clave"], $_POST["mail"], $_POST["nombre"]);
    
    if($user->ModificarClave($_POST["claveNueva"])){

        echo "Clave modificada con exito";

    } else {

        echo "Error al guardar";
    }
    


} else {

    echo "Verificar parametros ingresados";
}


?>