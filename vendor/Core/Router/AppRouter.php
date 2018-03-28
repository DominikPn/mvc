<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:58
 */

namespace TinyMvc\Router;


use TinyMvc\Request\Request;
use TinyMvc\Request\RequestInterface;
use TinyMvc\Router\AppRouterBinding;
use TinyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfoImpl;

class AppRouter implements Router, RouterBinder
{

    public $allowedMethods = ['POST', 'GET', 'PUT', 'DELETE'];

    private $request;

    public $routes = [];

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getControllerData()
    {
        foreach ($this->routes as $route) {
            if ($this->comparePathToRoute($this->request, $route)) {
                return $this->createControllerBuilderInfo($route->getAction());
            }
        }

        throw new \Exception("Undefinded route");
    }

    public function bind(string $methodName, string $path, $action)
    {
        $this->checkIfMethodAllowed($methodName);

        $route = new AppRouterBinding();
        $route->method($methodName);
        $route->path($path);
        $route->action($action);
        $this->routes[] = $route;

        return $route;
    }

    private function checkIfMethodAllowed(string $methodName)
    {
        if (!in_array($methodName, $this->allowedMethods)) throw new \Exception('Undefinded method');
    }

    private function comparePathToRoute(RequestInterface $request, RouterBinding $route)
    {
        $path = $request->getPath();
        $method = $request->getMethod();

        $expectedPath = $route->getPath();
        $expectedMethod = $route->getMethod();

        return ($path == $expectedPath) && ($method == $expectedMethod);
    }

    private function createControllerBuilderInfo($action)
    {

            $data = explode('@',$action);
            $controlerBuilderInfo =  new ControllerBuilderInfoImpl($data[0], $data[1]);
            $controlerBuilderInfo->addVariable('test',123);
            return $controlerBuilderInfo;
    }

}