<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';

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
		$mail= $ArrayDeParametros['mail'];
		$localidad= $ArrayDeParametros['localidad'];
		$fecha_de_registro=date("Y-m-d");
        
        $user = new Usuario();
        $user->nombre=$nombre;
        $user->apellido=$apellido;
        $user->clave=$clave;
		$user->mail=$mail;
		$user->localidad=$localidad;
		$user->fecha_de_registro=$fecha_de_registro;

        $user->InsertarUsuarioParametros();

        $archivos = $request->getUploadedFiles();
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior)  ;
        //var_dump($nombreAnterior);
        $extension=array_reverse($extension);

        $archivos['foto']->moveTo($destino.$nombre.".".$extension[0]);
        $response->getBody()->write("se guardo la foto");

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
     	//$response->getBody()->write("<h1>Modificar  uno</h1>");
     	$ArrayDeParametros = $request->getParsedBody();
	    //var_dump($ArrayDeParametros);    	
	    $user = new Usuario();
	    $user->id_usuario=$ArrayDeParametros['id_usuario'];
	    $user->nombre=$ArrayDeParametros['nombre'];
	    $user->apellido=$ArrayDeParametros['apellido'];
	    $user->clave=$ArrayDeParametros['clave'];
		$user->mail=$ArrayDeParametros['mail'];
		$user->localidad=$ArrayDeParametros['localidad'];
		$user->fecha_de_registro=date("Y-m-d");

	   	$resultado =$user->ModificarUsuarioParametros();
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}