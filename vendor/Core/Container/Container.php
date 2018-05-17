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
    public function singleton(string $abstract, $mixed);
    public function bind(string $abstract, $mixed);

    /**
     * @return mixed
     */
    public function make(string $className);
}