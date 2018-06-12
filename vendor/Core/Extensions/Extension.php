<?php

namespace MyMvc\Extensions;

interface Extension
{
    public function container();
    public function boot();
    public function register();
}