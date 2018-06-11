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

    public $singleton = [];
    public $bindings = [];

    /**
     * Rejestrujemy bindowanie typu singleton
     * @param string $abstract
     * @param $mixed
     */
    public function singleton(string $abstract, $mixed)
    {
        $this->singleton[$abstract] = $mixed;
    }

    /**
     * Zwykły typ bindowania
     *
     * @param string $abstract Namespace typu abstrakcyjnego do ktorego przypiszemy implementacje
     * @param $mixed Konkretna implementacja
     */
    public function bind(string $abstract, $mixed)
    {
        $this->bindings[$abstract] = $mixed;
    }

    /**
     * Metoda tworzy nam instancje klasy na podstawie podanej przezstrzeni nazw ( Jesli podamy typ abstrakcyjny bez przypisanej implementacji, metoda żuci wyjątek)
     * @param string $className Namespace klasy ktorą chcemy zwrócić z kontenera
     * @return mixed|object
     * @throws \Exception Wyjątek jeśli przekroczymy dopuszczalną ilość rekurencji
     */
    public function make(string $className)
    {
        self::$reflectionCount = 0;
        return $this->createClassInstance($className);

    }

    /**
     * @param string $className
     * @return object
     * @throws \Exception
     */
    private function createClassInstance(string $className)
    {

        ++self::$reflectionCount;
        //sprawdzamy czy nie przekroczylismy ilości wywołań rekurencyjnych
        if (self::$reflecitonLimit < self::$reflectionCount) throw new \Exception("Infinitie reflection error");

        //sprawdzamy czy namespace klasy lub interfejsu ma przypisaną implementację. Jeżeli namespace jest przypisany do konkretnej implementacji tworzymy instancje klasy.
        if ($this->checkIfClassHasBinding($className)) return $this->createClassInstance($this->bindings[$className]);

        $reflection = new \ReflectionClass($className);

        //pobieramy konstruktor tworzonej klasy
        $reflectionConstructor = $reflection->getConstructor();
        if ($reflectionConstructor == null) {
            return $reflection->newInstance();
        }

        $parameters = $reflectionConstructor->getParameters();

        //jesli konstruktor nie posiada parametrow to staramy sie utworzyc instancje klasy
        if (count($parameters) == 0) {
            return $reflection->newInstance();
        } else { //Tworzymy instancje klas podanych w konstruktorze
            $args = [];
            foreach ($parameters as $parameter) {
                $args[] = $this->createClassInstance($parameter->getClass()->getName());
            }
            return $reflection->newInstanceArgs($args);
        }


    }

    private function checkIfClassHasBinding(string $className)
    {
        return array_key_exists($className, $this->bindings);
    }
}