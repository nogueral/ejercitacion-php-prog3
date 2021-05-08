<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/usuario/usuarioApi.php';
require_once './clases/mesa/mesaApi.php';
require_once './clases/producto/productoApi.php';
require_once './clases/pedido/pedidoApi.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/usuario', function () {
 
  $this->get('/', \usuarioApi::class . ':traerTodos');
 
  $this->get('/{id_usuario}', \usuarioApi::class . ':traerUno');

  $this->post('/', \usuarioApi::class . ':CargarUno');

  $this->post('/validarUsuario', \usuarioApi::class . ':ValidarUsuario');

  $this->delete('/', \usuarioApi::class . ':BorrarUno');

  $this->put('/', \usuarioApi::class . ':ModificarUno');
     
});

$app->group('/producto', function () {
 
  $this->get('/', \productoApi::class . ':traerTodos');
 
  $this->get('/{id_producto}', \productoApi::class . ':traerUno');

  $this->post('/', \productoApi::class . ':CargarUno');

  $this->delete('/', \productoApi::class . ':BorrarUno');

  $this->put('/', \productoApi::class . ':ModificarUno');
     
});


$app->group('/mesa', function () {
 
  $this->get('/', \mesaApi::class . ':traerTodos');
 
  $this->get('/{id_mesa}', \mesaApi::class . ':traerUno');

  $this->post('/', \mesaApi::class . ':CargarUno');

  $this->delete('/', \mesaApi::class . ':BorrarUno');

  $this->put('/', \mesaApi::class . ':ModificarUno');
     
});

$app->run();