<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:40
 */

namespace MyMvc\Kernel;

use MyMvc\Config\AppConfig;
use MyMvc\Container\Container;
use MyMvc\ControllerResolver\ControllerResolver;
use MyMvc\Response\ResponseInterface;
use MyMvc\Router\Router;

class Kernel
{
    public $appConfig;
    public $controllerResolver;
    public $router;
    public $container;

    public function __construct(Router $router, ControllerResolver $controllerResolver, Container $container, AppConfig $appConfig)
    {
        $this->appConfig = $appConfig;
        $this->container = $container;
        $this->controllerResolver = $controllerResolver;
        $this->router = $router;

        $this->loadExtensions();
    }

    /**
     * Tworzymy odpowiedz dla klienta
     *
     * @return ResponseInterface
     */
    public function execute()
    {

        $controllerData = $this->router->getControllerData();
        $controllerInstance = $this->container->make($controllerData->getNameSpace());
        $response = $this->controllerResolver->callController($controllerData, $controllerInstance);

        return $response;
    }

    protected function loadExtensions()
    {
        $extensions_list = $this->appConfig->read('extensions');
        if ($extensions_list == null) throw new \Exception('Undefinded path for extensions list');

        $extensions = $this->buildExtensions($extensions_list);
        $this->registerExtensions($extensions);
        $this->bootExtensions($extensions);
    }

    /**
     * Utworzenie instancji rozszerzen
     *
     * @param array $extensions_names
     * @return array
     */
    protected function buildExtensions(array $extensions_names)
    {
        $extensions = [];
        foreach ($extensions_names as $classNamespace) {
            $fullClassNamespace = '\\'.$classNamespace;
            $extensions[] = new $fullClassNamespace($this->container);
        }
        return $extensions;
    }

    /**
     * Wywolanie metody register na wszystkich zarejestrowanych rozszerzeniach
     *
     * @param array $extensions
     */
    protected function registerExtensions(array $extensions = [])
    {
        foreach ($extensions as $extension) {
            $extension->register();
        }
    }

    /**
     * Wywolanie metody boot na wszystkich zarejestrowanych rozszerzeniach
     *
     * @param array $extensions
     */
    protected function bootExtensions(array $extensions = [])
    {
        foreach ($extensions as $extension) {
            $extension->boot();
        }
    }
}