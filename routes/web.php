<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:59
 */

$router->bind('GET', '/', '\App\Controllers\TestController@index')->name('controller');
$router->bind('GET', '/testZmiennej/{zmienna}', '\App\Controllers\TestController@metodaZeZmienna')->name('metodaZeZmienna');
$router->bind('GET', '/testa/jolo', '\App\Controllers\TestController@index')->name('controller');
$router->bind('GET', '/testa/{wololo}/jolo/{test}', '\App\Controllers\TestController@index')->name('controller');