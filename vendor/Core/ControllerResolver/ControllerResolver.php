<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:17
 */

namespace MyMvc\ControllerResolver;


use MyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfo;

interface ControllerResolver
{
    /**
     * @return \MyMvc\Response\ResponseInterface
     */
    public function callController(ControllerBuilderInfo $controllerBuilderInfo,$controller);
}