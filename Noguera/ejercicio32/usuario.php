<?php 
/**
 *  
 */

 include_once "AccesoDatos.php";
class Usuario 
{
	public $id;
 	public $nombre;
  	public $apellido;
  	public $clave;
    public $mail;
    public $fecha_de_registro;
    public $localidad;

	function __construct(){

	}

    public static function ConstructorParametrizado($clave = "", $mail = "", $nombre = "", $apellido = "", $fecha_de_registro = "", $localidad = "", $id = -1){
        $user = new Usuario();

        $user->nombre = $nombre;
		$user->apellido = $apellido;
		$user->clave = $clave;
		$user->mail = $mail;
		$user->fecha_de_registro = $fecha_de_registro;
		$user->localidad = $localidad;
		$user->id = $id;

        return $user;
    }


	public function InsertarUsuarioParametros()
	{
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,fecha_de_registro,localidad)values(:nombre,:apellido,:clave,:mail,:fecha_de_registro,:localidad)");
			   $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
			   $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
			   $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
			   $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
			   $consulta->bindValue(':fecha_de_registro', $this->fecha_de_registro, PDO::PARAM_STR);
			   $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public function ModificarUsuarioParametros($nuevaClave)
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               UPDATE usuario 
               SET clave=:nuevaClave
               WHERE mail=:mail AND clave=:clave");        
			   $consulta->bindValue(':nuevaClave', $nuevaClave, PDO::PARAM_STR);
			   $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
               $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);

           return $consulta->execute();
    }

	
	public static function TraerTodosLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public static function ImprimirUsuarios(){

		$lista = Usuario::TraerTodosLosUsuarios();

		foreach($lista as $user)
		{
			echo "<ul>";
			foreach($user as $item)
			{
				echo "<li>$item</li>";
			}
            
			echo "</ul>";
		}

	}

    public static function VerificarUsuario($usuario){

		$retorno = "Usuario no registrado";
		$vec = Usuario::TraerTodosLosUsuarios();

		foreach($vec as $auxUsuario){

			if(trim($auxUsuario->mail) == trim($usuario->mail))
			{
				if(trim($auxUsuario->clave) == trim($usuario->clave)){

					$retorno = "Verificado";
				} else {

					$retorno = "Error en los datos";

				}
			}

		}

		return $retorno;
	}

	public function ModificarClave($nuevaClave){

		$retorno = false;


		if(Usuario::VerificarUsuario($this) == "Verificado"){

			$this->ModificarUsuarioParametros($nuevaClave);
			$retorno = true;
		}

		return $retorno;
	}
}


 ?>