<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:40
 */

namespace TinyMvc\Kernel;


use App\TestClass;
use TinyMvc\Config\AppConfig;
use TinyMvc\Container\Container;
use TinyMvc\ControllerResolver\ControllerResolver;
use TinyMvc\Response\Response;
use TinyMvc\Response\ResponseInterface;
use TinyMvc\Router\Router;

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
     * @return ResponseInterface
     */
    public function execute(){

        $controllerData = $this->router->getControllerData();
        $controllerInstance = $this->container->make( $controllerData->getNameSpace() );
        $response = $this->controllerResolver->callController($controllerData,$controllerInstance);

        return $response;
    }

}