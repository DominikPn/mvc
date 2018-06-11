<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:52
 */

namespace MyMvc\Config;

/**
 * Konfiguracja aplikacji
 *
 * Class AppConfig
 * @package MyMvc\Config
 */
class AppConfig implements Config
{
    /**
     * Odczytuje wartosc z podanego źrodła
     * @param string $src
     * @param mixed $default Wartość domyślna w razie braku wpisu w konfiguracji
     * @return mixed
     */
    public function read(string $src, $default)
    {
        return $default;
    }

}