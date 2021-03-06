<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 15:50
 */

namespace MyMvc\Router;


interface RouterBinding
{
    /**
     * @return string post put itp itd
     */
    public function getMethod();

    public function name(string $name);

    public function getName();

    public function path(string $url);

    public function getPath();

    public function action($action);

    /**
     * @return closure or string object@method
     */
    public function getAction();

    public function method(string $method);
}