<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:45
 */

namespace MyMvc\Extensions;


use MyMvc\Container\Container;

interface Extension
{
    public function container(Container $container);
    public function boot();
    public function register();
}