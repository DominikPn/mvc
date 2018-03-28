<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 18:20
 */

namespace TinyMvc\Kernel\ControllerBuilderInfo;


class ControllerBuilderInfoImpl implements ControllerBuilderInfo
{

    private $variables = [];

    private $nameSpace;
    private $method;


    public function __construct(string $nameSpace,string $method)
    {
        $this->nameSpace = $nameSpace;
        $this->method = $method;
    }

    public function addVariable(string $name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function getNameSpace()
    {
        return $this->nameSpace;
    }

    public function getMethod()
    {
        return $this->method;
    }


}