<?php
class Producto{

    private $codigoBarra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;
    private $id;

    public function __construct($codigoBarra, $nombre, $tipo, $stock, $precio, $id = -1)
    {
        $this->codigoBarra = $codigoBarra;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        if($id != -1)
        {
            $this->id = $id;

        } else 
        {
            $this->id = random_int(1, 10000);
        }
        
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


}
?>