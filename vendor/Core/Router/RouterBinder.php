<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 15:44
 */

namespace TinyMvc\Router;


interface RouterBinder
{
    /**
     * @return \TinyMvc\Router\RouterBinding
     */
    public function bind(string $methodName, string $path, $action);
}