<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 15:21
 */

namespace MyMvc\Router;

use MyMvc\Request\RequestInterface;

interface Router
{
    public function setRequest(RequestInterface $request);
    public function getRequest();

    /**
     * @return \MyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfo
     */
    public function getControllerData();
}