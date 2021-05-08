<?php
require_once 'pedido.php';
require_once 'C:/xampp\htdocs/Noguera/APIREST-PHP-POO2021/apirest-LaComanda/clases/IApiUsable.php';

class pedidoApi extends Pedido implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id_mesa'];
    	$mesa=Mesa::TraerUnaMesa($id);
     	$newResponse = $response->withJson($mesa, 200);  
    	return $newResponse;
    }
	
     public function TraerTodos($request, $response, $args) {
      	$traerTodasLasMesas=Mesa::TraerTodasLasMesas();
     	$newResponse = $response->withJson($traerTodasLasMesas, 200);  
    	return $newResponse;
    }

      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        $nroMesa= $ArrayDeParametros['nroMesa'];
        $cantComensales= $ArrayDeParametros['cantComensales'];
        
        $mesa = new Mesa();
        $mesa->nroMesa=$nroMesa;
        $mesa->cantComensales=$cantComensales;

        $mesa->InsertarMesaParametros();

        $response->getBody()->write("Se cargo la mesa correctamente");

        return $response;
    }

      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id_mesa'];
     	$mesa= new Mesa();
     	$mesa->id_mesa=$id;
     	$cantidadDeBorrados=$mesa->BorrarMesa();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantComensales=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="Mesa eliminada";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="No se pudo eliminar mesa";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();   	
	    $mesa = new Mesa();
	    $mesa->id_mesa=$ArrayDeParametros['id_mesa'];
	    $mesa->nroMesa=$ArrayDeParametros['nroMesa'];
	    $mesa->cantComensales=$ArrayDeParametros['cantComensales'];

	   	$resultado =$mesa->ModificarMesaParametros();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}