<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:40
 */

namespace MyMvc\Kernel;


use App\TestClass;
use MyMvc\Config\AppConfig;
use MyMvc\Container\Container;
use MyMvc\ControllerResolver\ControllerResolver;
use MyMvc\Response\Response;
use MyMvc\Response\ResponseInterface;
use MyMvc\Router\Router;

class Kernel
{
    public $appConfig;
    public $controllerResolver;
    public $router;
    public $container;

    public function __construct(Router $router, ControllerResolver $controllerResolver, Container $container,AppConfig $appConfig)
    {
        $this->appConfig = $appConfig;
        $this->container = $container;
        $this->controllerResolver = $controllerResolver;
        $this->router = $router;
    }

    /**
     * Tworzymy odpowiedz dla klienta
     *
     * @return ResponseInterface
     */
    public function execute(){

        $controllerData = $this->router->getControllerData();
        $controllerInstance = $this->container->make( $controllerData->getNameSpace() );
        $response = $this->controllerResolver->callController($controllerData,$controllerInstance);

        return $response;
    }

}