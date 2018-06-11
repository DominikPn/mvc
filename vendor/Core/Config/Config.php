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
     * Odczytuje wartość z podanego źródła
     *
     * @param string $src
     * @param $default Wartość domyślna w razie braku wpisu w konfiguracji
     * @return mixed
     */
    public function read(string $src, $default);
}