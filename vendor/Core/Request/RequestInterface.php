<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 14:43
 */

namespace MyMvc\Request;

interface RequestInterface
{
    public function getPath();
    public function getMethod();
    public function getUrl();
    public function input(string $kay, string $default);
    public function getHost();
    public function getReferer();
    public function getProtocol();
    public function getServerAddress();
    public function getName();
}