<?php
class usuario
{
	public $id_usuario;
 	public $nombre;
  	public $apellido;
  	public $clave;
	public $userName;
	public $puesto;
	public $fecha_de_ingreso;



  	public function BorrarUsuario()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE id_usuario=:id_usuario");	
				$consulta->bindValue(':id_usuario',$this->id_usuario, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public function ModificarUsuario()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set nombre='$this->nombre',
				apellido='$this->apellido',
				clave='$this->clave',
				userName='$this->userName',
				puesto='$this->puesto',
				fecha_de_ingreso='$this->fecha_de_ingreso'
				WHERE id_usuario='$this->id_usuario'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarUsuario()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,userName,puesto,fecha_de_ingreso)values('$this->nombre','$this->apellido','$this->clave','$this->userName','$this->puesto','$this->fecha_de_ingreso')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	  public function ModificarUsuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("update usuario 
			set nombre=:nombre,
			apellido=:apellido,
			clave=:clave,
			userName=:userName,
			puesto=:puesto,
			fecha_de_ingreso=:fecha_de_ingreso
			WHERE id_usuario=:id_usuario");
			$consulta->bindValue(':id_usuario',$this->id_usuario, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
			$consulta->bindValue(':userName', $this->userName, PDO::PARAM_STR);
			$consulta->bindValue(':puesto', $this->puesto, PDO::PARAM_STR);
			$consulta->bindValue(':fecha_de_ingreso', $this->fecha_de_ingreso, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,userName,puesto,fecha_de_ingreso)values(:nombre,:apellido,:clave,:userName,:puesto,:fecha_de_ingreso)");
				$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
				$consulta->bindValue(':userName', $this->userName, PDO::PARAM_STR);
				$consulta->bindValue(':puesto', $this->puesto, PDO::PARAM_STR);
				$consulta->bindValue(':fecha_de_ingreso', $this->fecha_de_ingreso, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }


  	public static function TraerTodosLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public static function TraerUnUsuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where id_usuario = $id");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				

			
	}

	public static function VerificarUsuario($userName, $clave){

		$vec = self::TraerTodosLosUsuarios();

		foreach($vec as $auxUsuario){

			if(trim($auxUsuario->userName) == trim($userName))
			{
				if(trim($auxUsuario->clave) == trim($clave)){

					return true;
				} 
			}

		}

		return false;
	}


	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->apellido."  ".$this->fecha_de_ingreso."  ".$this->clave."  ".$this->userName."  ".$this->puesto."  ".$this->id_usuario;
	}



}