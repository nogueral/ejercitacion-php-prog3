<?php
class usuario
{
	public $id_usuario;
 	public $nombre;
  	public $apellido;
  	public $clave;
	public $mail;
	public $localidad;
	public $fecha_de_registro;



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

	public static function BorrarCdPorFechaRegistro($fecha_de_registro)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE fecha_de_registro=:fecha_de_registro");	
				$consulta->bindValue(':fecha_de_registro',$fecha_de_registro, PDO::PARAM_STR);		
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
				mail='$this->mail',
				localidad='$this->localidad',
				fecha_de_registro='$this->fecha_de_registro'
				WHERE id_usuario='$this->id_usuario'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarUsuario()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,localidad,fecha_de_registro)values('$this->nombre','$this->apellido','$this->clave','$this->mail','$this->localidad','$this->fecha_de_registro')");
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
			mail=:mail,
			localidad=:localidad,
			fecha_de_registro=:fecha_de_registro
			WHERE id_usuario=:id_usuario");
			$consulta->bindValue(':id_usuario',$this->id_usuario, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
			$consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
			$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
			$consulta->bindValue(':fecha_de_registro', $this->fecha_de_registro, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,localidad,fecha_de_registro)values(:nombre,:apellido,:clave,:mail,:localidad,:fecha_de_registro)");
				$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
				$consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
				$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
				$consulta->bindValue(':fecha_de_registro', $this->fecha_de_registro, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function GuardarUsuario()
	 {

	 	if($this->id_usuario>0)
	 		{
	 			$this->ModificarUsuarioParametros();
	 		}else {
	 			$this->InsertarUsuarioParametros();
	 		}

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

	public static function TraerUnUsuarioFecha($id,$fecha) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  * from usuario  WHERE id_usuario='$id' AND fecha_de_registro='$fecha'");
			$consulta->execute(array($id, $fecha));
			$cdBuscado= $consulta->fetchObject('usuario');
      		return $cdBuscado;				

			
	}

	public static function TraerUsuarioFechaParamNombre($id,$fecha) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  * from usuario  WHERE id_usuario=:id AND fecha_de_registro=:fecha");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('usuario');
      		return $cdBuscado;				

			
	}
	
	public static function TraerUnUsuarioFechaParamNombreArray($id,$fecha) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  * from usuario  WHERE id_usuario=:id AND fecha_de_registro=:fecha");
			$consulta->execute(array(':id'=> $id,':fecha'=> $fecha));
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('usuario');
      		return $cdBuscado;				

			
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->apellido."  ".$this->fecha_de_registro."  ".$this->clave."  ".$this->mail."  ".$this->localidad."  ".$this->id_usuario;
	}

	public static function VerificarUsuario($mail, $clave){

		$vec = self::TraerTodosLosUsuarios();

		foreach($vec as $auxUsuario){

			if(trim($auxUsuario->mail) == trim($mail))
			{
				if(trim($auxUsuario->clave) == trim($clave)){

					return true;
				} 
			}

		}

		return false;
	}

}