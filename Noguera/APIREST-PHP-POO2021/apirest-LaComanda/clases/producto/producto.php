<?php
class Producto
{
	public $id_producto;
 	public $descripcion;
  	public $cantidad;
  	public $tipo;

  	public function BorrarProducto()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from producto 				
				WHERE id_producto=:id_producto");	
				$consulta->bindValue(':id_usuario',$this->id_usuario, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }


	  public function ModificarProductoParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("update producto 
			set descripcion=:descripcion,
			cantidad=:cantidad,
			tipo=:tipo
			WHERE id_producto=:id_producto");
			$consulta->bindValue(':id_producto',$this->id_producto, PDO::PARAM_INT);
			$consulta->bindValue(':descripcion',$this->descripcion, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_INT);
			$consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarProductoParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (descripcion,cantidad,tipo)values(:descripcion,:cantidad,:tipo)");
				$consulta->bindValue(':descripcion',$this->descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_INT);
				$consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }


  	public static function TraerTodosLosProducto()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}

	public static function TraerUnProducto($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto where id_producto = $id");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				

			
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostrar: ".$this->descripcion."  ".$this->cantidad."  ".$this->tipo."  ".$this->id_producto;
	}



}