<?php

include_once "./AccesoDatos.php";

class Venta
{
    private $id_usuario;
    private $cantidad;
    private $id_producto;
    private $fecha_de_venta;

    public function __construct()
    {
        
    }


    public static function ConstructorParametrizado($id_usuario, $cantidad, $id_producto)
    {
        $venta = new Venta();

        $venta->id_usuario = $id_usuario;
        $venta->cantidad = $cantidad;
        $venta->id_producto = $id_producto;
        $venta->fecha_de_venta = date("Y-m-d");

        return $venta;

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

    public static function TablaVentasConParametro($lista){

        echo "<table>";
		foreach($lista as $user)
		{
			echo "<tr>";
			foreach($user as $item)
			{
				echo "<td>$item</td>";
			}
            
			echo "</tr>";
		}
        echo "</table>";

	}


    //--------------------------BASE DE DATOS-----------------------------------


    public function InsertarVentaParametros()
	{
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (id_producto,id_usuario,cantidad,fecha_de_venta)values(:id_producto,:id_usuario,:cantidad,:fecha_de_venta)");
			   $consulta->bindValue(':id_producto',$this->id_producto, PDO::PARAM_INT);
			   $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
			   $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			   $consulta->bindValue(':fecha_de_venta', $this->fecha_de_venta, PDO::PARAM_STR);
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

    //C. Obtener todas las compras filtradas entre dos cantidades.

    public static function TraerVentasPorCantidades($min, $max)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from venta WHERE cantidad BETWEEN :min AND :max");
            $consulta->bindValue(':min', $min, PDO::PARAM_INT);
            $consulta->bindValue(':max', $max, PDO::PARAM_INT);
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

    // D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.

    public static function TotalProductosVendidos($fechaMin, $fechaMax)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select SUM(cantidad) AS 'cantidadTotal' from venta WHERE fecha_de_venta BETWEEN :fechaMin AND :fechaMax");
            $consulta->bindValue(':fechaMin', $fechaMin, PDO::PARAM_STR);
            $consulta->bindValue(':fechaMax', $fechaMax, PDO::PARAM_STR);
			$consulta->execute();			
			return $consulta->fetch(PDO::FETCH_ASSOC);		
	}

        //E. Mostrar los primeros “N” números de productos que se han enviado.

        public static function MostrarProductosParcial($max)
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM venta ORDER BY fecha_de_venta ASC LIMIT :max");
                $consulta->bindValue(':max', $max, PDO::PARAM_INT);
                $consulta->execute();			
                $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "venta");	
                
                
                foreach($lista as $user)
                {
                    echo "<ul>";
                    echo "<li>$user->id_producto</li>";
                    echo "</ul>";
                }
        }

        //F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.

        public static function ListadoUsuarioYProducto()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT usuario.nombre as nombreUsuario , producto.nombre as nombreProducto FROM `usuario` INNER JOIN `venta` ON usuario.id_usuario = venta.id_usuario INNER JOIN `producto` ON producto.id_producto = venta.id_producto");
                $consulta->execute();			
                return $consulta->fetchAll(PDO::FETCH_OBJ);	

        }

        //G. Indicar el monto (cantidad * precio) por cada una de las ventas.

        public static function MontoVentaPorUnidad(){

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT venta.cantidad*producto.precio as monto FROM `venta` INNER JOIN `producto` ON venta.id_producto = producto.id_producto");
            $consulta->execute();			
            return $consulta->fetchAll(PDO::FETCH_OBJ);	

        }

        //H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario (ejemplo: 104).

        public static function CantidadTotalPorUsuario($producto, $usuario){

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT SUM(`cantidad`) as 'cantidadTotal' FROM `venta` WHERE `id_producto` = :producto && `id_usuario` = :usuario");
            $consulta->bindValue(':producto', $producto, PDO::PARAM_INT);
            $consulta->bindValue(':usuario', $usuario, PDO::PARAM_INT);
            $consulta->execute();			
            return $consulta->fetchAll(PDO::FETCH_OBJ);	
        }

        //I. Obtener todos los números de los productos vendidos por algún usuario filtrado por localidad (ejemplo: ‘Avellaneda’).

        public static function ProductosPorLocalidad($localidad){

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id_producto as id FROM `venta` INNER JOIN `usuario` ON usuario.id_usuario = venta.id_usuario WHERE usuario.localidad = :localidad
            ");
            $consulta->bindValue(':localidad', $localidad, PDO::PARAM_STR);
            $consulta->execute();			
            return $consulta->fetchAll(PDO::FETCH_OBJ);	

        }

        //K. Mostrar las ventas entre dos fechas del año.

        public static function VentasEntreDosFechas($fechaUno, $fechaDos){

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `venta` WHERE `fecha_de_venta` BETWEEN :fechaUno AND :fechaDos");
            $consulta->bindValue(':fechaUno', $fechaUno, PDO::PARAM_STR);
            $consulta->bindValue(':fechaDos', $fechaDos, PDO::PARAM_STR);
            $consulta->execute();			
            return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");	

        }


}
?>