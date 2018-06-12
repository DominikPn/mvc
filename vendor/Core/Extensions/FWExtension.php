<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-06-12
 * Time: 21:09
 */

namespace MyMvc\Extensions;


use MyMvc\Container\Container;

abstract class FWExtension implements Extension
{
    private $container = null;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function container() : Container
    {
        return $this->container;
    }

    abstract public function boot();

    abstract public function register();


}