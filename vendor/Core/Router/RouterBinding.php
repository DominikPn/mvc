<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 15:50
 */

namespace TinyMvc\Router;


interface RouterBinding
{
    /**
     * @return string post put itp itd
     */
    public function getMethod();

    public function name(string $name);

    public function getName();

    public function url(string $url);

    public function getUrl();

    public function action($action);

    public function getAction();
}