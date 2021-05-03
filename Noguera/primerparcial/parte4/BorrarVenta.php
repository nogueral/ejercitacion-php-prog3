<?php
/*
LEANDRO NOGUERA

7- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
la carpeta /BACKUPVENTAS*/

include_once "./venta.php";


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"),$put_vars);

    $retorno = Venta::TraerUnaVenta($put_vars["nroPedido"]);

    if($retorno != false){

        echo Venta::MoverDirectorioFotografia($retorno);
        echo "<br/>";

        $retorno = Venta::BorrarVentaPorNroPedido($put_vars["nroPedido"]);

            if($retorno != 0){
                echo "Se eliminaron los datos";
            } else{

                echo "Nro de pedido erroneo";
            }

    } else {

        echo "Nro de pedido inexistente";
    }


} else {

    echo "Error en los parametros ingresados";
}


?>