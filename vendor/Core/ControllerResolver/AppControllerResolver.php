<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 17:23
 */

namespace MyMvc\ControllerResolver;


use MyMvc\Container\Container;
use MyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfo;

/**
 * Klasa ktróra tworzy nam kontroler
 *
 * Class AppControllerResolver
 * @package MyMvc\ControllerResolver
 */
class AppControllerResolver implements ControllerResolver
{
    private $container;

    /**
     * AppControllerResolver constructor.
     * @param Container $container Kontener
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Metoda wywołuje odpowiednią metodę na obiekcie kontrolera
     *
     * @param ControllerBuilderInfo $controllerBuilderInfo
     * @param $controller
     * @return mixed|\ReflectionClass
     */
    public function callController(ControllerBuilderInfo $controllerBuilderInfo, $controller)
    {
        $reflectionMethod = new \ReflectionMethod($controller, $controllerBuilderInfo->getMethod());
        $additionalVariables = $controllerBuilderInfo->getVariables();
        $parameters = $reflectionMethod->getParameters();
        $finalArgs = [];

        foreach ($parameters as $parameter){
            $this->assignValueToPropety($parameter,$additionalVariables,$finalArgs);
        }
        //wywolanie metody kontrolera
        return $reflectionMethod->invokeArgs($controller,$finalArgs);
    }

    /**
     * Przygotowanie zmiennyych pobranych przez routing i utworzenie instancji potrzebnych klas
     *
     * @param \ReflectionParameter $parameter
     * @param array $additionalVariables
     * @param array $finalArgs
     * @throws \Exception
     */
    private function assignValueToPropety(\ReflectionParameter $parameter, array $additionalVariables,array &$finalArgs){
        $parameterName = $parameter->getName();
        if( array_key_exists($parameterName,$additionalVariables) ) $finalArgs[] = $additionalVariables[$parameterName];
        else{
            $parameterClass = $parameter->getClass();
            if($parameterClass != null)  $finalArgs[] = $this->container->make($parameterClass->getName());
        }
    }
}