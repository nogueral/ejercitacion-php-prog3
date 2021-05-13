<?php
class Pedido
{
	public $id_pedido;
 	public $nroPedido;
  	public $nroMesa;
	public $nombreCliente;
	public $producto;
	public $tipo;
	public $cantidad;
	public $estado;
	  

  	public function BorrarPedido()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from pedido 				
				WHERE id_pedido=:id_pedido");	
				$consulta->bindValue(':id_pedido',$this->id_pedido, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }


	  public function ModificarPedidoParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("update pedido 
			set nroPedido=:nroPedido,
			nroMesa=:nroMesa,
			nombreCliente=:nombreCliente,
			producto=:producto,
			tipo=:tipo,
			cantidad=:cantidad,
			estado=:estado
			WHERE id_pedido=:id_pedido");
			$consulta->bindValue(':id_pedido',$this->id_pedido, PDO::PARAM_INT);
			$consulta->bindValue(':nroPedido',$this->nroPedido, PDO::PARAM_STR);
			$consulta->bindValue(':nroMesa', $this->nroMesa, PDO::PARAM_INT);
			$consulta->bindValue(':nombreCliente', $this->nombreCliente, PDO::PARAM_STR);
			$consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
			$consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarPedidoParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedido (nroPedido,nroMesa,nombreCliente,producto,tipo,cantidad,estado)values(:nroPedido,:nroMesa,:nombreCliente,:producto,:tipo,:cantidad,:estado)");
				$consulta->bindValue(':nroPedido',$this->nroPedido, PDO::PARAM_STR);
				$consulta->bindValue(':nroMesa', $this->nroMesa, PDO::PARAM_INT);
				$consulta->bindValue(':nombreCliente', $this->nombreCliente, PDO::PARAM_STR);
				$consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
				$consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
				$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
				$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }


  	public static function TraerTodosLosPedidos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from pedido");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "pedido");		
	}

	public static function TraerUnPedido($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from pedido where id_pedido = $id");
			$consulta->execute();
			$pedido= $consulta->fetchObject('pedido');
			return $pedido;				

			
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostrar: ".$this->id_pedido."  ".$this->nroPedido."  ".$this->nroMesa."  ".$this->nombreCliente." ".$this->producto." ".$this->tipo." ".$this->cantidad." ".$this->estado;
	}



}