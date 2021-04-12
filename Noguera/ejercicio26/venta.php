<?php
class Venta
{
    private $idUsuario;
    private $cantItems;
    private $codigoBarra;
    private $id;

    public function __construct($idUsuario, $cantItems, $codigoBarra)
    {
        $this->idUsuario = $idUsuario;
        $this->cantItems = $cantItems;
        $this->codigoBarra = $codigoBarra;
        $this->id = random_int(1,10000);
    }

    function Venta_toArray()
    {
        return get_object_vars($this);
    }

    public static function Guardar($venta)
    {
        $retorno = false;

        $archivo = fopen("ventas.json", "a");

        if($archivo != false)
        {
            if(fwrite($archivo, json_encode($venta->Venta_toArray()) . "\n") != false)
            {
                $retorno = true;
            }

            fclose($archivo);
        }

        return $retorno;
    }
}
?>