<?php
class Pedido
{
	public $id_pedido;
 	public $nroPedido;
  	public $nroMesa;
	  

  	public function BorrarMesa()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from mesa 				
				WHERE id_mesa=:id_mesa");	
				$consulta->bindValue(':id_mesa',$this->id_mesa, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }


	  public function ModificarMesaParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("update mesa 
			set nroMesa=:nroMesa,
			cantComensales=:cantComensales
			WHERE id_mesa=:id_mesa");
			$consulta->bindValue(':id_mesa',$this->id_mesa, PDO::PARAM_INT);
			$consulta->bindValue(':nroMesa',$this->nroMesa, PDO::PARAM_INT);
			$consulta->bindValue(':cantComensales', $this->cantComensales, PDO::PARAM_INT);
			return $consulta->execute();
	 }

	 public function InsertarMesaParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mesa (nroMesa,cantComensales)values(:nroMesa,:cantComensales)");
				$consulta->bindValue(':nroMesa',$this->nroMesa, PDO::PARAM_INT);
				$consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_INT);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }


  	public static function TraerTodasLasMesas()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from mesa");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "mesa");		
	}

	public static function TraerUnaMesa($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from mesa where id_mesa = $id");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('mesa');
			return $usuarioBuscado;				

			
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostrar: ".$this->nroMesa."  ".$this->cantidad."  ".$this->id_mesa."  ".$this->id_producto;
	}



}