<?php

include_once "./AccesoDatos.php";

class Venta
{
    private $id_usuario;
    private $cantidad;
    private $id_producto;
    private $fecha_de_venta;

    public function __construct()
    {
        
    }


    public static function ConstructorParametrizado($id_usuario, $cantidad, $id_producto)
    {
        $venta = new Venta();

        $venta->id_usuario = $id_usuario;
        $venta->cantidad = $cantidad;
        $venta->id_producto = $id_producto;
        $venta->fecha_de_venta = date("Y-m-d");

        return $venta;

    }


    //--------------------------BASE DE DATOS-----------------------------------


    public function InsertarVentaParametros()
	{
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (id_producto,id_usuario,cantidad,fecha_de_venta)values(:id_producto,:id_usuario,:cantidad,:fecha_de_venta)");
			   $consulta->bindValue(':id_producto',$this->id_producto, PDO::PARAM_INT);
			   $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
			   $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			   $consulta->bindValue(':fecha_de_venta', $this->fecha_de_venta, PDO::PARAM_STR);
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}
}
?>