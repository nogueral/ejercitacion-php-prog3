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
}


 ?>