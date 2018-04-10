<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 17:23
 */

namespace TinyMvc\ControllerResolver;


use TinyMvc\Container\Container;
use TinyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfo;

class AppControllerResolver implements ControllerResolver
{
    private $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function callController(ControllerBuilderInfo $controllerBuilderInfo, $controller)
    {
        $reflectionMethod = new \ReflectionMethod($controller, $controllerBuilderInfo->getMethod());
        $additionalVariables = $controllerBuilderInfo->getVariables();
       // var_dump($additionalVariables);
        $parameters = $reflectionMethod->getParameters();

        $finalArgs = [];

        foreach ($parameters as $parameter){
            $this->assignValueToPropety($parameter,$additionalVariables,$finalArgs);
        }

        return $reflectionMethod->invokeArgs($controller,$finalArgs);
    }

    private function assignValueToPropety(\ReflectionParameter $parameter, array $additionalVariables,array &$finalArgs){
        $parameterName = $parameter->getName();
        if( array_key_exists($parameterName,$additionalVariables) ) $finalArgs[] = $additionalVariables[$parameterName];
        else{
            $parameterClass = $parameter->getClass();
            if($parameterClass != null)  $finalArgs[] = $this->container->make($parameterClass->getName());
        }
    }
}