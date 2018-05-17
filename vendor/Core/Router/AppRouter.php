<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:58
 */

namespace MyMvc\Router;


use App\TestClass;
use MyMvc\Request\Request;
use MyMvc\Request\RequestInterface;
use MyMvc\Router\AppRouterBinding;
use MyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfoImpl;

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
            $path = $this->request->getPath();
            $routePath = $route->getPath();
            $regexPath = $this->convertPathToRegex($routePath);
            $routeMethod = $route->getMethod();
            $requestMethod = $this->request->getMethod();
		
            /* check if route is equal to request route */
            if ( $this->comparePaths($regexPath, $path) && ($routeMethod == $requestMethod) ) {
                $variableNames = $this->extractVariableNames($routePath);
                $variableNamesAndValues = $this->extractVariableValues($regexPath, $path, $variableNames);
                return $this->createControllerBuilderInfo($route->getAction(),$variableNamesAndValues);
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

    private function createControllerBuilderInfo($action,$additionalVariables)
    {
        $data = explode('@', $action);
        $controllerBuilderInfo = new ControllerBuilderInfoImpl($data[0], $data[1]);
        foreach ($additionalVariables as $kay=>$value){
            $controllerBuilderInfo->addVariable($kay, $value);
        }
        return $controllerBuilderInfo;
    }

    /* Convert string '/sample/{asd}' to array [ '{asd}' ] */
    private function extractVariableNames(string $path)
    {
        $matches = null;
        preg_match_all('/\{([a-z]+)\}/', $path, $matches);
        return $matches[1];
    }

    private function convertPathToRegex(string $path)
    {
        $regexPath = preg_replace('/\{[a-z]+\}/', '(.*)', $path);
        $regexPath = str_replace('/', '\/', $regexPath);
        $regexPath = '/^' . $regexPath . '$/';

        return $regexPath;
    }

    private function comparePaths(string $regexPath, string $path)
    {
        return preg_match(''.$regexPath.'', $path);
    }

    private function extractVariableValues(string $regexPatch, string $path,array $variableNames)
    {
        $matches = null;
        $variableAndValue = [];
        preg_match_all($regexPatch, $path, $matches);

        foreach ($variableNames as $kay=>$name){
            $variableAndValue[$name]=$matches[$kay+1][0];
        }
        return $variableAndValue;
    }
}