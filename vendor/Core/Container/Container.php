<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:34
 */

namespace MyMvc\Container;


interface Container
{
    /**
     * Rejestrujemy bindowanie typu singleton
     * @param string $abstract
     * @param $mixed
     */
    public function singleton(string $abstract, $mixed);

    /**
     * Zwykły typ bindowania
     *
     * @param string $abstract Namespace typu abstrakcyjnego do ktorego przypiszemy implementacje
     * @param $mixed Konkretna implementacja
     */
    public function bind(string $abstract, $mixed);

    /**
     * Metoda tworzy nam instancje klasy na podstawie podanej przezstrzeni nazw ( Jesli podamy typ abstrakcyjny bez przypisanej implementacji, metoda żuci wyjątek)
     * @param string $className Namespace klasy ktorą chcemy zwrócić z kontenera
     * @return mixed|object
     * @throws \Exception Wyjątek jeśli przekroczymy dopuszczalną ilość rekurencji
     */
    public function make(string $className);
}