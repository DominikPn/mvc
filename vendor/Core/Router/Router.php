<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 15:21
 */

namespace TinyMvc\Router;

use TinyMvc\Request\RequestInterface;

interface Router
{
    public function setRequest(RequestInterface $request);
    public function getRequest();

    /**
     * @return \TinyMvc\Kernel\ControllerBuilderInfo\ControllerBuilderInfo
     */
    public function getControllerData();
}