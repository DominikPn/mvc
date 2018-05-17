<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 15:44
 */

namespace MyMvc\Router;


interface RouterBinder
{
    /**
     * @return \MyMvc\Router\RouterBinding
     */
    public function bind(string $methodName, string $path, $action);
}