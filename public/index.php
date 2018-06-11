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

//Tworzymy obiekt request z globalnych zmiennych
$request = Request::make();

//Tworzymi obiekt routera
$router = new AppRouter($request);

//rejestrujemy możliwe scieżki
require_once '../routes/web.php';

//Tworzymy kontener zależnosci
$container = new AppContainer();

//Przypisujemy do interfejsu implementacje
$container->bind('App\TestInterface','App\TestClass');

//Tworzymy instancje klasy budującej nasze kontrolery
$controllerResolver = new AppControllerResolver($container);

//Konfiguracja naszej aplikacji
$config = new AppConfig();

//i tu się wsyzstko zaczyna
$kernel = new Kernel($router, $controllerResolver, $container, $config);

$response = $kernel->execute();

//Wysłanie odpowiedzi do kliensta
$response->send();

