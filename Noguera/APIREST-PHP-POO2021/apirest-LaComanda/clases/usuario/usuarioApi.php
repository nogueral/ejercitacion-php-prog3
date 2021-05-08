<?php
require_once 'usuario.php';
require_once 'C:/xampp\htdocs/Noguera/APIREST-PHP-POO2021/apirest-LaComanda/clases/IApiUsable.php';

class usuarioApi extends usuario implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id_usuario'];
    	$user=Usuario::TraerUnUsuario($id);
     	$newResponse = $response->withJson($user, 200);  
    	return $newResponse;
    }
     public function TraerTodos($request, $response, $args) {
      	$todosLosUsuarios=Usuario::TraerTodosLosUsuarios();
     	$newResponse = $response->withJson($todosLosUsuarios, 200);  
    	return $newResponse;
    }
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $clave= $ArrayDeParametros['clave'];
		$userName= $ArrayDeParametros['userName'];
		$puesto= $ArrayDeParametros['puesto'];
		$fecha_de_ingreso=date("Y-m-d");
        
        $user = new Usuario();
        $user->nombre=$nombre;
        $user->apellido=$apellido;
        $user->clave=$clave;
		$user->userName=$userName;
		$user->puesto=$puesto;
		$user->fecha_de_ingreso=$fecha_de_ingreso;

        $user->InsertarUsuarioParametros();

        $response->getBody()->write("Se cargo el usuario correctamente");

        return $response;
    }

      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id_usuario'];
     	$user= new Usuario();
     	$user->id_usuario=$id;
     	$cantidadDeBorrados=$user->BorrarUsuario();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="algo borro!!!";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="no Borro nada!!!";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();   	
	    $user = new Usuario();
	    $user->id_usuario=$ArrayDeParametros['id_usuario'];
	    $user->nombre=$ArrayDeParametros['nombre'];
	    $user->apellido=$ArrayDeParametros['apellido'];
	    $user->clave=$ArrayDeParametros['clave'];
		$user->userName=$ArrayDeParametros['userName'];
		$user->puesto=$ArrayDeParametros['puesto'];
		$user->fecha_de_registro=date("Y-m-d");

	   	$resultado =$user->ModificarUsuarioParametros();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}