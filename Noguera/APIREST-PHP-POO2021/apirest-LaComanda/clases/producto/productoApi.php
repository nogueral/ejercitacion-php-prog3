<?php
require_once 'producto.php';
require_once 'C:/xampp\htdocs/Noguera/APIREST-PHP-POO2021/apirest-LaComanda/clases/IApiUsable.php';

class productoApi extends Producto implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id_producto'];
    	$user=Producto::TraerUnProducto($id);
     	$newResponse = $response->withJson($user, 200);  
    	return $newResponse;
    }
	
     public function TraerTodos($request, $response, $args) {
      	$todosLosProductos=Producto::TraerTodosLosProducto();
     	$newResponse = $response->withJson($todosLosProductos, 200);  
    	return $newResponse;
    }

      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        $descripcion= $ArrayDeParametros['descripcion'];
        $cantidad= $ArrayDeParametros['cantidad'];
        $tipo= $ArrayDeParametros['tipo'];
        
        $producto = new Producto();
        $producto->descripcion=$descripcion;
        $producto->cantidad=$cantidad;
        $producto->tipo=$tipo;

        $producto->InsertarProductoParametros();

        $response->getBody()->write("Se cargo el producto correctamente");

        return $response;
    }

      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id_producto'];
     	$producto= new Producto();
     	$producto->id_producto=$id;
     	$cantidadDeBorrados=$producto->BorrarProducto();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="Producto eliminado";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="No se pudo eliminar producto";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();   	
	    $producto = new Producto();
	    $producto->id_producto=$ArrayDeParametros['id_producto'];
	    $producto->descripcion=$ArrayDeParametros['descripcion'];
	    $producto->cantidad=$ArrayDeParametros['cantidad'];
	    $producto->tipo=$ArrayDeParametros['tipo'];

	   	$resultado =$producto->ModificarProductoParametros();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}