<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:59
 */

$router->bind('GET', '/', '\App\Controllers\TestController@index')->name('controller');
$router->bind('GET', '/test/{zmienna}', '\App\Controllers\TestController@metodaZeZmienna')->name('metodaZeZmienna');
$router->bind('GET', '/test/{zmienna}/Janusz/{zmienna2}', '\App\Controllers\TestController@metodaZeZmienna2')->name('metodaZeZmienna2');
$router->bind('GET', '/containerTest/{jakasWartosc}', '\App\Controllers\TestController@containerTest')->name('testResolva');
$router->bind('GET', '/container', '\App\Controllers\TestController@containerBindingTest')->name('testResolva');