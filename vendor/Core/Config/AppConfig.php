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
    private $path = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Odczytuje wartosc z podanego źródła
     * @param string $src
     * @param mixed $default Wartość domyślna w razie braku wpisu w konfiguracji
     * @return mixed
     */
    public function read(string $src, $default = null)
    {
        $fileName = $this->parseFileName($src);
        $keys = $this->parseArrayKeys($src);
        $fullConfigPath = $this->path.'/'.$fileName;

        if(!is_file($fullConfigPath)) return $default;

        $config = include($fullConfigPath);

        foreach ($keys as $key) {
            if(!isset($config[$key])) return $default;
            $config = $config[$key];
        }

        return $config;
    }

    /**
     * Wyciągamy nazwę pliku
     *
     * @param string $path
     * @return string
     */
    public function parseFileName(string $path) : string
    {
       $parts = explode('.',$path);
       return $parts[0].'.php';
    }

    /**
     * Wyciągamy nazwy potrzebnych kluczy
     *
     * @param string $path
     * @return array
     */
    public function parseArrayKeys(string $path) : array
    {
        $parts = explode('.',$path);
        unset($parts[0]);
        return $parts;
    }
}