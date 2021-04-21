<?php
 include_once "./AccesoDatos.php";

class Producto{

    private $id_producto;
    private $codigo_de_barra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;
    private $fecha_de_creacion;
    private $fecha_de_modificacion;

    public function __construct()
    {
        
    }

    public static function ConstructorParametrizado($codigo_de_barra, $nombre, $tipo, $stock, $precio){

        $prod = new Producto();

        $prod->codigo_de_barra = $codigo_de_barra;
        $prod->nombre = $nombre;
        $prod->tipo = $tipo;
        $prod->stock = $stock;
        $prod->precio = $precio;
        $prod->fecha_de_creacion = date("Y-m-d");
        $prod->fecha_de_modificacion = date("Y-m-d");
        $prod->id_producto;

        return $prod;

    }


    function Producto_toArray(){

        return get_object_vars($this);
    }

    public static function Guardar($prod, $mode)
    {
        $retorno = false;

        $archivo = fopen("C:/xampp/htdocs/Noguera/ejercicio25/producto.json", $mode);

        if($archivo != false)
        {
            if(fwrite($archivo, json_encode($prod->Producto_toArray()) . "\n") != false)
            {
                $retorno = true;
            }

            fclose($archivo);
        }

        return $retorno;
    }

    public static function Leer()
    {
        $retorno = false;
        $vec = array();

        $archivo = fopen("C:/xampp/htdocs/Noguera/ejercicio25/producto.json", "r");

        if($archivo != false)
        {
            while(!feof($archivo))
            {
                $lectura = fgets($archivo);
                $auxVec = json_decode($lectura, true);

                if($auxVec != null)
                {
                    $prod = new Producto($auxVec["codigoBarra"], $auxVec["nombre"], $auxVec["tipo"], $auxVec["stock"], $auxVec["precio"], $auxVec["id"]);

                    array_push($vec, $prod);
                }
            }
        }

        return $vec;
    }

   
    public static function VerificarProducto($prod)
    {
        $vec = Producto::Leer();
        $productoExistente = false;
        $retorno = "No se pudo hacer";

        if($prod != null)
        {
            foreach($vec as $auxProd)
            {
                if($auxProd->codigoBarra == $prod->codigoBarra)
                {
                    $productoExistente = true;
                    $auxProd->stock = $prod->stock;
                    break;
                }
            }
    
            if($productoExistente)
            {
                $mode = "w";
    
                foreach($vec as $auxProd)
                {
                    Producto::Guardar($auxProd, $mode);
                    $mode = "a";
                }
    
                $retorno = "Actualizado";
    
            } else {
    
                Producto::Guardar($prod, "a");
                $retorno = "Ingresado";
            }
        }

        return $retorno;
    }

    public static function ProductoExistente($codigoBarra, $stock)
    {
        $vec = Producto::Leer();
        $productoExistente = false;

        foreach($vec as $auxProd)
        {
            if($auxProd->codigoBarra == $codigoBarra && $auxProd->stock >= $stock)
            {
                $productoExistente = true;
                break;
            }
        }

        return $productoExistente;

    }

    public static function ModificarStock($codigoBarra, $stock)
    {
        $vec = Producto::Leer();
        $productoExistente = false;

        foreach($vec as $auxProd)
        {
            if($auxProd->codigoBarra == $codigoBarra)
            {
                $productoExistente = true;
                $auxProd->stock -= $stock;
                break;
            }
        }

        if($productoExistente)
        {
            $mode = "w";

            foreach($vec as $auxProd)
            {
                Producto::Guardar($auxProd, $mode);
                $mode = "a";
            }

            $retorno = "Actualizado";

        }

        return $productoExistente;
    }

    // BASE DE DATOS

    public static function VerificarProductoDB($prod)
    {
        $vec = Producto::TraerTodosLosProductos();
        $productoExistente = false;
        $retorno = "No se pudo hacer";

        if($prod != null)
        {
            foreach($vec as $auxProd)
            {
                if($auxProd->codigo_de_barra == $prod->codigo_de_barra)
                {
                    $productoExistente = true;
                    //$auxProd->stock = $prod->stock;
                    break;
                }
            }
    
            if($productoExistente)
            {
                $prod->ModificarProductoParametros();

                $retorno = "Actualizado";
    
            } else {
    
                $prod->InsertarProductoParametros();
                
                $retorno = "Ingresado";
            }
        }

        return $retorno;
    }


    public function InsertarProductoParametros()
	{
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion)values(:codigo_de_barra,:nombre,:tipo,:stock,:precio,:fecha_de_creacion,:fecha_de_modificacion)");
			   $consulta->bindValue(':codigo_de_barra',$this->codigo_de_barra, PDO::PARAM_INT);
			   $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
			   $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
			   $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
               $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
			   $consulta->bindValue(':fecha_de_creacion', $this->fecha_de_creacion, PDO::PARAM_STR);
			   $consulta->bindValue(':fecha_de_modificacion', $this->fecha_de_modificacion, PDO::PARAM_STR);
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

    public function ModificarProductoParametros()
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               UPDATE producto 
               SET nombre=:nombre,
               tipo=:tipo,
               stock=:stock,
               precio=:precio,
               fecha_de_modificacion=:fecha_de_modificacion
               WHERE codigo_de_barra=:codigo_de_barra");        
			   $consulta->bindValue(':codigo_de_barra',$this->codigo_de_barra, PDO::PARAM_INT);
			   $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
			   $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
			   $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
               $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
			   $consulta->bindValue(':fecha_de_modificacion', $this->fecha_de_modificacion, PDO::PARAM_STR);
           return $consulta->execute();
    }



    public static function TraerTodosLosProductos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}

    
	public static function ImprimirProductos(){

		$lista = Producto::TraerTodosLosProductos();

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


}
?>