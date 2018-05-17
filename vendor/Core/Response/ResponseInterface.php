<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:01
 */

namespace MyMvc\Response;


interface ResponseInterface
{
    public function redirect(string $url);
    public function contentDispos(string $contentDispos);
    public function contentType(string $contentType);
    public function status(string $status);
    public function getBody();
    public function send();
}