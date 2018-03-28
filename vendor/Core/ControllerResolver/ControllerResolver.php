<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:17
 */

namespace TinyMvc\ControllerResolver;


use TinyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfo;

interface ControllerResolver
{
    /**
     * @return \ReflectionClass
     */
    public function callController(ControllerBuilderInfo $controllerBuilderInfo,$controller);
}