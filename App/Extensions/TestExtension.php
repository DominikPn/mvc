<?php

namespace App\Extensions;

use App\TestClass;
use App\TestInterface;
use MyMvc\Extensions\FWExtension as Extension;

class TestExtension extends Extension
{
    public function boot()
    {
        $testClass = $this->container()->make(TestInterface::class);
    }

    public function register()
    {
        $this->container()->bind(TestInterface::class, TestClass::class);
    }
}