<?php

include_once "./usuario.php";

$user = new Usuario(2222, "leandrodnog@gmail.com");
    
echo Usuario::VerificarUsuario($user);

?>