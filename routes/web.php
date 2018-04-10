<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 16:59
 */

$router->bind('GET', '/testa/{wololo}/jolo/{test}', '\App\Controllers\TestController@index')->name('controller');