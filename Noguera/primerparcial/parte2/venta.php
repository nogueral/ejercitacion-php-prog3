<?php

include_once "./AccesoDatos.php";

class Venta{

    private $usuario;
    private $sabor;
    private $tipo;
    private $cantidad;
    private $fecha;
    private $nroPedido;
    private $id_venta;
    private $destino;


    public static function ConstructorParametrizado($usuario, $sabor, $tipo, $cantidad, $destino, $id_venta = -1){

        $venta = new Venta();

        $venta->usuario = $usuario;
        $venta->sabor = $sabor;
        $venta->tipo = $tipo;
        $venta->cantidad = $cantidad;
        $venta->fecha = date("Y-m-d");
        $venta->nroPedido = random_int(1,1000);
        $venta->id_venta = $id_venta;
        $venta->destino = $destino;

        return $venta;
    }

    public function InsertarVentaParametros()
	{
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta_pizza (usuario,tipo,cantidad,sabor,nroPedido,fecha,destino)values(:usuario,:tipo,:cantidad,:sabor,:nroPedido,:fecha, :destino)");
			   $consulta->bindValue(':usuario',$this->usuario, PDO::PARAM_STR);
			   $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
			   $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			   $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
               $consulta->bindValue(':nroPedido', $this->nroPedido, PDO::PARAM_INT);
			   $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
               $consulta->bindValue(':destino', $this->destino, PDO::PARAM_STR);
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

    public static function GuardarImagen(){

        $mail = explode("@", $_POST["usuario"]);

        $destino = "C:/xampp/htdocs/Noguera/primerparcial/ImagenesDeLaVenta/" . $_POST["tipo"] . $_POST["sabor"] . $mail[0] . ".jpg";
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);

        return $destino;
    }

}

?>