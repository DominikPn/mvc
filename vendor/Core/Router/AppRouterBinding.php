<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 17:53
 */

namespace TinyMvc\Router;


class AppRouterBinding implements  RouterBinding
{
    private $method;
    private $name;
    private $url;
    private $action;

    public function method(string $method)
    {
        $this->method= $method;
    }
    public function getMethod()
    {
        return $this->method;
    }

    public function name(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function path(string $url)
    {
        $this->url = $url;
    }

    public function getPath()
    {
        return $this->url;
    }

    public function action($action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

}