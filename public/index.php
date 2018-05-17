<?php
require_once '../vendor/autoload.php';

/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 14:48
 */

use MyMvc\Kernel\Kernel;
use MyMvc\Router\AppRouter;
use MyMvc\Request\Request;
use MyMvc\ControllerResolver\AppControllerResolver;
use MyMvc\Container\AppContainer;
use \MyMvc\Config\AppConfig;


$request = Request::make();

$router = new AppRouter($request);

require_once '../routes/web.php';


$container = new AppContainer();

$container->bind('App\TestInterface','App\TestClass');

$controllerResolver = new AppControllerResolver($container);

$config = new AppConfig();

$kernel = new Kernel($router, $controllerResolver, $container, $config);

$response = $kernel->execute();

$response->send();

