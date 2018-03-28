<?php
require_once '../vendor/autoload.php';

/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 14:48
 */

use TinyMvc\Kernel\Kernel;
use TinyMvc\Router\AppRouter;
use TinyMvc\Request\Request;
use TinyMvc\ControllerResolver\AppControllerResolver;
use TinyMvc\Container\AppContainer;
use \TinyMvc\Config\AppConfig;


//$test = function ($asd){
//    echo 'dupa';
//};

//$reflection = new ReflectionClass($test);
//$reflectionMethod= $reflection->getMethod('call');
//
//var_dump ($reflectionMethod->invoke($test,'asd'));

$request = Request::make();

$router = new AppRouter($request);

require_once '../routes/web.php';


$container = new AppContainer();
$container->bind(\App\TestInterface::class,\App\TestClass::class);
$controllerResolver = new AppControllerResolver($container);

$config = new AppConfig();

$kernel = new Kernel($router, $controllerResolver, $container, $config);

$response = $kernel->execute();

$response->send();

