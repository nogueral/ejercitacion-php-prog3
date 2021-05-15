<?php
require_once 'pedido.php';
require_once 'C:/xampp\htdocs/Noguera/APIREST-PHP-POO2021/apirest-LaComanda/clases/IApiUsable.php';

class pedidoApi extends Pedido implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id_pedido'];
    	$pedido=Pedido::TraerUnPedido($id);
     	$newResponse = $response->withJson($pedido, 200);  
    	return $newResponse;
    }
	
     public function TraerTodos($request, $response, $args) {
      	$traerTodosLosPedidos=Pedido::TraerTodosLosPedidos();
     	$newResponse = $response->withJson($traerTodosLosPedidos, 200);  
    	return $newResponse;
    }

      public function CargarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
		$nroPedido= $ArrayDeParametros['nroPedido'];
        $nroMesa= $ArrayDeParametros['nroMesa'];
		$nombreCliente= $ArrayDeParametros['nombreCliente'];
		$producto= $ArrayDeParametros['producto'];
		$tipo= $ArrayDeParametros['tipo'];
		$cantidad= $ArrayDeParametros['cantidad'];
		$estado= $ArrayDeParametros['estado'];
        
        $pedido = new Pedido();
        $pedido->nroPedido=$nroPedido;
        $pedido->nroMesa=$nroMesa;
		$pedido->nombreCliente=$nombreCliente;
		$pedido->producto=$producto;
		$pedido->tipo=$tipo;
		$pedido->cantidad=$cantidad;
		$pedido->estado=$estado;

        $pedido->InsertarPedidoParametros();

		$archivos = $request->getUploadedFiles();
		if($archivos['foto']->getError() === UPLOAD_ERR_OK){
			$destino="C:/xampp/htdocs/Noguera/APIREST-PHP-POO2021/apirest-LaComanda/clases/pedido/fotos";
			var_dump($archivos);
			//var_dump($archivos['foto']);
	
			$nombreAnterior=$archivos['foto']->getClientFilename();
			$extension= explode(".", $nombreAnterior);
			//var_dump($nombreAnterior);
			$extension=array_reverse($extension);
	
			$archivos['foto']->moveTo($destino.$pedido->nroPedido.".".$extension[0]);
		}

        $response->getBody()->write("Se cargo pedido correctamente");

        return $response;
    }

      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id_pedido'];
     	$pedido= new Pedido();
     	$pedido->id_mesa=$id;
     	$cantidadDeBorrados=$pedido->BorrarPedido();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidadDeBorrados=$cantidadDeBorrados;
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
		$nroPedido= $ArrayDeParametros['nroPedido'];
        $nroMesa= $ArrayDeParametros['nroMesa'];
		$nombreCliente= $ArrayDeParametros['nombreCliente'];
		$producto= $ArrayDeParametros['producto'];
		$tipo= $ArrayDeParametros['tipo'];
		$cantidad= $ArrayDeParametros['cantidad'];
		$estado= $ArrayDeParametros['estado'];

		$pedido = new Pedido();
		$pedido->nroPedido=$nroPedido;
        $pedido->nroMesa=$nroMesa;
		$pedido->nombreCliente=$nombreCliente;
		$pedido->producto=$producto;
		$pedido->tipo=$tipo;
		$pedido->cantidad=$cantidad;
		$pedido->estado=$estado;

	   	$resultado =$pedido->ModificarPedidoParametros();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}