<?php
include_once "./AccesoDatos.php";

class Venta{

    private $usuario;
    private $sabor;
    private $tipo;
    private $cantidad;
    private $fecha;
    private $nroPedido;
    private $id_venta;
    private $destino;

    public function __construct()
    {
        
    }


    public static function ConstructorParametrizado($usuario, $sabor, $tipo, $cantidad, $destino, $id_venta = -1){

        $venta = new Venta();

        $venta->usuario = $usuario;
        $venta->sabor = $sabor;
        $venta->tipo = $tipo;
        $venta->cantidad = $cantidad;
        $venta->fecha = date("Y-m-d");
        $venta->nroPedido = random_int(1,1000);
        $venta->id_venta = $id_venta;
        $venta->destino = $destino;

        return $venta;
    }

    public static function GuardarImagen(){

        $mail = explode("@", $_POST["usuario"]);

        $destino = "ImagenesDeLaVenta/" . $_POST["tipo"] . $_POST["sabor"] . $mail[0] . ".jpg";
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);

        return $destino;
    }

    public static function ImprimirVentasConParametro($lista){

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

    public function InsertarVentaParametros()
	{
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta_pizza (usuario,tipo,cantidad,sabor,nroPedido,fecha,destino)values(:usuario,:tipo,:cantidad,:sabor,:nroPedido,:fecha, :destino)");
			   $consulta->bindValue(':usuario',$this->usuario, PDO::PARAM_STR);
			   $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
			   $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			   $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
               $consulta->bindValue(':nroPedido', $this->nroPedido, PDO::PARAM_INT);
			   $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
               $consulta->bindValue(':destino', $this->destino, PDO::PARAM_STR);
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

    public static function CantidadPizzasVendidas()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select SUM(cantidad) as 'cantidadTotal' from venta_pizza");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}

    public static function VentasEntreDosFechas($fechaUno, $fechaDos){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `venta_pizza` WHERE `fecha` BETWEEN :fechaUno AND :fechaDos ORDER BY `sabor`");
        $consulta->bindValue(':fechaUno', $fechaUno, PDO::PARAM_STR);
        $consulta->bindValue(':fechaDos', $fechaDos, PDO::PARAM_STR);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");	

    }


    public static function VentasPorUsuario($usuario){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `venta_pizza` WHERE `usuario` = :usuario");
        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");	

    }

    public static function VentasPorSabor($sabor){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `venta_pizza` WHERE `sabor` = :sabor");
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");	

    }


    public static function ModificarVentaParametros($usuario, $sabor, $tipo, $cantidad, $nroPedido)
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               UPDATE venta_pizza 
               SET usuario=:usuario,
               sabor=:sabor,
               tipo=:tipo,
               cantidad=:cantidad
               WHERE nroPedido=:nroPedido");        
			   $consulta->bindValue(':usuario',$usuario, PDO::PARAM_STR);
			   $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
			   $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
			   $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
			   $consulta->bindValue(':nroPedido', $nroPedido, PDO::PARAM_INT);
               $consulta->execute();
           
               return $consulta->rowCount();
    }

    public static function BorrarVentaPorNroPedido($nroPedido)
    {

           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               delete 
               from `venta_pizza` 				
               WHERE nroPedido=:nroPedido");	
               $consulta->bindValue(':nroPedido',$nroPedido, PDO::PARAM_INT);		
               $consulta->execute();
               return $consulta->rowCount();

    }

    public static function TraerUnaVenta($nroPedido) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from venta_pizza where nroPedido = :nroPedido");
            $consulta->bindValue(':nroPedido',$nroPedido, PDO::PARAM_INT);
			$consulta->execute();
			return $consulta->fetchObject('venta');				

			
	}

    public static function MoverDirectorioFotografia($venta){

        $dir = opendir("C:/xampp/htdocs/Noguera/primerparcial/ImagenesDePizzas");
        $retorno = "No se pudo mover";

        if($file = readdir($dir) != false){

            $mail = explode("@", $venta->usuario);
            $ruta = $venta->destino;
            if(copy($ruta, "C:/xampp/htdocs/Noguera/primerparcial/BACKUPVENTAS/" . $venta->tipo . $venta->sabor . $mail[0] . $venta->fecha . ".jpg")){

                $retorno = "Se ha cambiado la imagen de directorio";
            } 
            
        }

        closedir($dir);

        return $retorno;
    }

}


?>