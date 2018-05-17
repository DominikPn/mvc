<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 17:04
 */

namespace MyMvc\Request;


class Request implements RequestInterface
{
    private static $request;
    private  $method;
    private  $path;

    private function __construct()
    {
       $this->path = $_SERVER['REQUEST_URI'];
       $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public static function make(){
        if(self::$request == null)
        {
            self::$request = new self();
            return self::$request;
        }
        return self::$request;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        // TODO: Implement getUrl() method.
    }

    public function input(string $kay, string $default)
    {
        // TODO: Implement input() method.
    }

    public function getHost()
    {
        // TODO: Implement getHost() method.
    }

    public function getReferer()
    {
        // TODO: Implement getReferer() method.
    }

    public function getProtocol()
    {
        // TODO: Implement getProtocol() method.
    }

    public function getServerAddress()
    {
        // TODO: Implement getServerAddress() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function getPath()
    {
        return $this->path;
    }


}