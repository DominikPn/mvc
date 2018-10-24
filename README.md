# mvc
PHP MVC framework. 

Fremowork support beautiful URLs.

Creating routes example:
  ```php
    //****Define in /routes/web.php****
  
    $router->bind('GET', '/', '\App\Controllers\TestController@index');
    //Adding route parameter
    $router->bind('GET', '/user/{id}', '\App\Controllers\TestController@showUserInfo');
    //Set route name
    $router->bind('POST','/welcome', '\App\Controllers\AnotherController@welcome')->name('welcomPage'); 
  ```

