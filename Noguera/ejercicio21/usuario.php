<?php 
/**
 *  
 */
class Usuario 
{
	private $nombre;
	private $clave;
	private $mail;
	
	function __construct($nombre, $clave, $mail)
	{
		$this->nombre = $nombre;
		$this->clave = $clave;
		$this->mail = $mail;
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

				$lectura = explode(",", fgets($archivo));
				array_push($vec, $lectura);
			
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
}


 ?>

