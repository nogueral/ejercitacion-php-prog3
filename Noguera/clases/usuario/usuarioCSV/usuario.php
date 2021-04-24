<?php 
/**
 *  
 */
class Usuario 
{
	private $nombre;
	private $clave;
	private $mail;
	
	function __construct($clave, $mail, $nombre = "sin nombre")
	{
		$this->clave = $clave;
		$this->mail = $mail;
		$this->nombre = $nombre;
	}

	public function GetClave(){

		return $this->clave;
	}

	public function GetMail(){

		return $this->mail;
	}

	public function GetDatos(){

		return $this->nombre . "," . $this->clave . "," . $this->mail;
	}

	public function Guardar(){

		$retorno = false;

		$archivo = fopen("usuarios.csv", "a");

		if($archivo != false){

			$escritura = fwrite($archivo, $this->GetDatos() . "\n");

			if($escritura != false){
				$retorno = true;
			}

			fclose($archivo);

		}

		return $retorno;
	}

	public static function Leer(){

		$vec = array();

		$archivo = fopen("usuarios.csv", "r");
		

		if($archivo != false){

			while(!feof($archivo)){

				$lectura = fgetcsv($archivo);
                if($lectura != null){
                    $usuario = new Usuario($lectura[1], $lectura[2], $lectura[0]);
                    array_push($vec, $usuario);
                }

			}

			fclose($archivo);

		}

		return $vec;

	}

	public static function ImprimirUsuarios($lista){

		foreach($lista as $user)
		{
			echo "<ul>";
			foreach($user as $elements)
			{

				echo "<li>$elements</li>";
			}
			echo "</ul>";
		}

	}

	public static function VerificarUsuario($usuario){

		$vec = Usuario::Leer();

		foreach($vec as $auxUsuario){

			if(trim($auxUsuario->mail) == trim($usuario->mail))
			{
				if(trim($auxUsuario->clave) == trim($usuario->clave)){

					return "Verificado";
				} else {

					return "Error en los datos";
				}
			}

		}

		return "Usuario no registrado";
	}
}


 ?>