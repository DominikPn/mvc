<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 15:30
 */

namespace TinyMvc\Kernel\ControllerBuilderInfo;


interface ControllerBuilderInfo
{
    public function addVariable(string $name, $value);

    /**
     * @return array
     */
    public function getVariables();

    public function getMethod();

    public function getNameSpace();
}