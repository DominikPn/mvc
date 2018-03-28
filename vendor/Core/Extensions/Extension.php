<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:45
 */

namespace TinyMvc\Extensions;


use TinyMvc\Container\Container;

interface Extension
{
    public function container(Container $container);
    public function boot();
    public function register();
}