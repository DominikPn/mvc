<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 17:30
 */

namespace TinyMvc\Response;


class Response implements ResponseInterface
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function redirect(string $url)
    {
        // TODO: Implement redirect() method.
    }

    public function contentDispos(string $contentDispos)
    {
        // TODO: Implement contentDispos() method.
    }

    public function contentType(string $contentType)
    {
        // TODO: Implement contentType() method.
    }

    public function status(string $status)
    {
        // TODO: Implement status() method.
    }

    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    public function send()
    {
        echo $this->content;
    }

}