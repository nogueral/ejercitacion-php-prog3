<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/usuarioApi.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

$VerificadorDeCredenciales = function ($request, $response, $next) {

  if($request->isGet())
  {
     $response->getBody()->write('<p>NO necesita credenciales para los get</p>');
     $response = $next($request, $response);
  }
  else
  {
    $response->getBody()->write('<p>verifico credenciales</p>');
    $ArrayDeParametros = $request->getParsedBody();
    $nombre=$ArrayDeParametros['mail'];
    $tipo=$ArrayDeParametros['tipo'];
    if($tipo=="administrador")
    {
      $response->getBody()->write("<h3>Bienvenido $nombre </h3>");
      $response = $next($request, $response);
    }
    else
    {
      $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
    }  
  }  
  $response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
  return $response;  
};

/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/usuario', function () {
 
  $this->get('/', \usuarioApi::class . ':traerTodos');
 
  $this->get('/{id_usuario}', \usuarioApi::class . ':traerUno');

  $this->post('/', \usuarioApi::class . ':CargarUno');

  $this->post('/validarUsuario', \usuarioApi::class . ':ValidarUsuario');

  $this->delete('/', \usuarioApi::class . ':BorrarUno');

  $this->put('/', \usuarioApi::class . ':ModificarUno');
     
})->add($VerificadorDeCredenciales);

$app->run();