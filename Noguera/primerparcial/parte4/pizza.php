<?php
class Pizza{

    private $sabor;
    private $precio;
    private $tipo;
    private $cantidad;
    private $id;

    public function __construct()
    {
        
    }


    public static function ConstructorParametrizado($sabor, $precio, $tipo, $cantidad, $id = -1)
    {
        $pizza = new Pizza();

        $pizza->sabor = $sabor;
        $pizza->precio = $precio;
        $pizza->cantidad = $cantidad;

        if($tipo == "molde" || $tipo == "piedra"){
            $pizza->tipo = $tipo;
        } else {
            $pizza->tipo = "molde";
        }

        if($id != -1)
        {
            $pizza->id = $id;

        } else 
        {
            $pizza->id = random_int(1, 10000);
        }

        return $pizza;
        
    }

    function Pizza_toArray(){

        return get_object_vars($this);
    }

    public static function Guardar($prod, $mode)
    {
        $retorno = false;

        $archivo = fopen("C:/xampp/htdocs/Noguera/primerparcial/parte1/pizza.json", $mode);

        if($archivo != false)
        {
            if(fwrite($archivo, json_encode($prod->Pizza_toArray()) . "\n") != false)
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

        $archivo = fopen("C:/xampp/htdocs/Noguera/primerparcial/parte1/pizza.json", "r");

        if($archivo != false)
        {
            if(filesize("C:/xampp/htdocs/Noguera/primerparcial/parte1/pizza.json") > 0){

                while(!feof($archivo))
                {
                    $lectura = fgets($archivo);
                    $auxVec = json_decode($lectura, true);
    
                    if($auxVec != null)
                    {
                        $prod = self::ConstructorParametrizado($auxVec["sabor"], $auxVec["precio"], $auxVec["tipo"], $auxVec["cantidad"], $auxVec["id"]);
    
                        array_push($vec, $prod);
                    }
                }
            }
        }

        return $vec;
    }

    public function Equals($pizza){

        if($this->tipo == $pizza->tipo && $this->sabor == $pizza->sabor){
            return true;
        } else {
            return false;
        }
    }

    public static function VerificarProducto($prod)
    {
        $vec = self::Leer();
        $productoExistente = false;
        $retorno = "No se pudo hacer";

        if($prod != null)
        {
            foreach($vec as $auxProd)
            {
                if($auxProd->Equals($prod))
                {
                    $productoExistente = true;
                    $auxProd->precio = $prod->precio;
                    $auxProd->cantidad += $prod->cantidad;
                    break;
                }
            }
    
            if($productoExistente)
            {
                $mode = "w";
    
                foreach($vec as $auxProd)
                {
                    self::Guardar($auxProd, $mode);
                    $mode = "a";
                }
    
                $retorno = "Actualizado";
    
            } else {
    
                self::Guardar($prod, "a");
                $retorno = "Ingresado";
            }
        }

        return $retorno;
    }

    public static function PizzaConsultar($sabor, $tipo){

        $vec = self::Leer();
        $haySabor = false;
        $hayTipo = false;
        $retorno = "";

        foreach($vec as $pizza){

            if($pizza->tipo == $tipo && $pizza->sabor == $sabor){
                return "Si hay";
            }
        }

        foreach($vec as $pizza){

            if($pizza->sabor == $sabor){
                $haySabor = true;
                break;
            }
        }

        foreach($vec as $pizza){

            if($pizza->tipo == $tipo){
                $hayTipo = true;
                break;
            }
        }

        if($haySabor == false){
            $retorno = "No hay sabor";
        }

        if($hayTipo == false){
            $retorno = "No hay tipo";
        }

        if($haySabor == false && $hayTipo == false){
            $retorno = "No existe ni tipo ni sabor";
        }

        return $retorno;
    }

    public static function VerificarPedido($sabor, $tipo, $cantidad){

        $vec = self::Leer();
        $retorno = false;
        $mode = "w";

        foreach($vec as $pizza){

            if($pizza->tipo == $tipo && $pizza->sabor == $sabor && $pizza->cantidad >= $cantidad){
                $pizza->cantidad -= $cantidad;
                $retorno = true;
                break;
            }
        }

        if($retorno == true){

            foreach($vec as $pizza){

                self::Guardar($pizza, $mode);
                $mode = "a";
            }

        }

        return $retorno;
    }

    public static function GuardarImagen(){

        $destino = "C:/xampp/htdocs/Noguera/primerparcial/ImagenesDePizzas/" . $_POST["tipo"] . $_POST["sabor"] .".jpg";
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
    }

}
?>