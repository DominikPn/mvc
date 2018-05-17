<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:39
 */

namespace MyMvc\Config;


interface Config
{
    /**
     * @return mixed
     */
    public function read(string $src,string $default);
}