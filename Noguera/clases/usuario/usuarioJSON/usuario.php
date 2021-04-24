<?php 
/**
 *  
 */
class Usuario 
{
	private $nombre;
	private $clave;
	private $mail;
    private $id;
    private $fecha;
    private $rutaArchivo;
	
    function __construct($clave, $mail, $nombre = "sin nombre", $rutaArchivo = "sin archivos adjuntos", $id = -1)
	{
		$this->clave = $clave;
		$this->mail = $mail;
		$this->nombre = $nombre;
        $this->fecha = new DateTime("Now");
        $this->rutaArchivo = $rutaArchivo;

        if($id == -1){
            $this->id = random_int(1, 10000);
        } else {
            $this->id = $id;
        }

	}

    function SetFecha($fecha){

        $this->fecha = new DateTime($fecha);
    }

    function JsonSerialize(){

        return get_object_vars($this);
    }


	public function GetDatos(){
        
		return $this->nombre . "," . $this->clave . "," . $this->mail . "," . $this->id . "," . $this->fecha->format("d-m-Y") . "," . "<img src='$this->rutaArchivo' width='280' height='125'/>";
	}

	public function Guardar(){

		$retorno = false;

		$archivo = fopen("usuarios.json", "a");

		if($archivo != false){

			$escritura = fwrite($archivo, json_encode($this->JsonSerialize()) . "\n");

			if($escritura != false){
				$retorno = true;
			}

			fclose($archivo);

		}

		return $retorno;
	}

	public static function Leer(){

		$vec = array();
        $auxVec = array();

		$archivo = fopen("usuarios.json", "r");
		

		if($archivo != false){

			while(!feof($archivo)){

				$lectura = fgets($archivo);
                $auxVec = json_decode($lectura, true);
                if($auxVec != null){

                    $usuario = new Usuario($auxVec["clave"], $auxVec["mail"], $auxVec["nombre"], $auxVec["rutaArchivo"], $auxVec["id"]);
                    $usuario->SetFecha($auxVec["fecha"]["date"]);
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
            $datos = $user->GetDatos();
            echo "<li>$datos</li>";
			echo "</ul>";
		}

	}

	public static function UsuarioExistente($id)
	{
		$vec = Usuario::Leer();
		$retorno = false;

		foreach($vec as $auxUsuario)
		{
			if($auxUsuario->id == $id)
			{
				$retorno = true;
				break;
			}
		}

		return $retorno;
	}
}


 ?>