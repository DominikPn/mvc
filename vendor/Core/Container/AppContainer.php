<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 17:24
 */

namespace MyMvc\Container;


class AppContainer implements Container
{
    private static $reflecitonLimit = 100;
    private static $reflectionCount = 0;

    public $singleton =[];
    public $bindings = [];

    public function singleton(string $abstract, $mixed)
    {
        $this->singleton[$abstract]=$mixed;
    }

    public function bind(string $abstract, $mixed)
    {
        $this->bindings[$abstract]=$mixed;
    }

    public function make(string $className)
    {
        self::$reflectionCount = 0;
        return $this->createClassInstance($className);

    }

    private function createClassInstance(string $className)
    {

        ++self::$reflectionCount;
        if(self::$reflecitonLimit < self::$reflectionCount) throw new \Exception("Infinitie reflection error");

        if($this->checkIfClassHasBinding($className)) return $this->createClassInstance($this->bindings[$className]);


        $reflection = new \ReflectionClass($className);

        $reflectionConstructor = $reflection->getConstructor();
        if($reflectionConstructor == null){
            return $reflection->newInstance();
        }

        $parameters = $reflectionConstructor->getParameters();

        if( count($parameters) == 0 ){
           return $reflection->newInstance();
        }else{
            $args = [];
            foreach ($parameters as $parameter){
                $args[]=$this->createClassInstance( $parameter->getClass()->getName() );
            }
            return $reflection->newInstanceArgs(  $args  ) ;
        }



    }

    private function checkIfClassHasBinding(string $className){
        return array_key_exists($className,$this->bindings);
    }
}