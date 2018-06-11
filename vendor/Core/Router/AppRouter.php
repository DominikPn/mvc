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
    /**
     * Dozwolone metody routingu
     * @var array
     */
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

    /**
     * Przypisanie sciezki do kontrolera
     *
     * @param string $methodName
     * @param string $path
     * @param $action
     * @return \MyMvc\Router\AppRouterBinding|RouterBinding
     * @throws \Exception
     */
    public function bind(string $methodName, string $path, $action)
    {
        //sprawdza czy metoda jest dozwolona
        $this->checkIfMethodAllowed($methodName);

        //tworzymy bindowanie routingu
        $route = new AppRouterBinding();
        $route->method($methodName);
        $route->path($path);
        $route->action($action);
        $this->routes[] = $route;

        return $route;
    }

    /**
     * Sprawdzamy czy metoda dozwolona
     *
     * @param string $methodName
     * @throws \Exception
     */
    private function checkIfMethodAllowed(string $methodName)
    {
        if (!in_array($methodName, $this->allowedMethods)) throw new \Exception('Undefinded method');
    }

    /**
     * Tworzymy obiekt z informacjami jak stworzyc kontroler i jakie metody wywolac
     *
     * @param $action
     * @param $additionalVariables
     * @return ControllerBuilderInfoImpl
     */
    private function createControllerBuilderInfo($action,$additionalVariables)
    {
        $data = explode('@', $action);
        $controllerBuilderInfo = new ControllerBuilderInfoImpl($data[0], $data[1]);
        foreach ($additionalVariables as $kay=>$value){
            $controllerBuilderInfo->addVariable($kay, $value);
        }
        return $controllerBuilderInfo;
    }

    /* Konwersja string '/sample/{asd}' na tablice [ '{asd}' ] */
    private function extractVariableNames(string $path)
    {
        $matches = null;
        preg_match_all('/\{([A-Za-z0-9]+)\}/', $path, $matches);
        return $matches[1];
    }

    /**
     * Konwersja scieżki na wyrażenie regularne
     *
     * @param string $path
     * @return mixed|null|string|string[]
     */
    private function convertPathToRegex(string $path)
    {
        $regexPath = preg_replace('/\{[A-Za-z0-9]+\}/', '([A-Za-z0-9]*)', $path);
        $regexPath = str_replace('/', '\/', $regexPath);
        $regexPath = '/^' . $regexPath . '$/';

        return $regexPath;
    }

    /**
     * Porownanie linku wywolanego przez uzytkownika z podaną sciezką
     *
     * @param string $regexPath
     * @param string $path
     * @return false|int
     */
    private function comparePaths(string $regexPath, string $path)
    {
        return preg_match(''.$regexPath.'', $path);
    }

    /**
     * Wyciagniecie wartosci zmienny z linku dla konkretnej scieżki
     *
     * @param string $regexPatch
     * @param string $path
     * @param array $variableNames
     * @return array
     */
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