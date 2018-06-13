<?php

namespace App\Extensions;

use App\TestClass;
use App\TestInterface;
use App\TestInterface2;
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
        $this->container()->bind(TestInterface2::class,function ($container){
           return new class implements TestInterface2{
               public function metodaTestInterface2()
               {
                   return 'metodaTestInterface2 z klasy anonimowej';
               }
           };
        });
    }
}