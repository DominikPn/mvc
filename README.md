# mvc
PHP MVC framework. 

Features:
 - beautiful URLs
 - dependency injection container
 - route parameters

Creating routes example:
  ```php
    //****Define in /routes/web.php****
  
    $router->bind('GET', '/', '\App\Controllers\TestController@index');
    //Adding route parameter
    $router->bind('GET', '/user/{id}', '\App\Controllers\TestController@showUserInfo');
    //Set route name
    $router->bind('POST','/welcome', '\App\Controllers\AnotherController@welcome')->name('welcomPage'); 
  ```
  
Register bindings in the container:
  
  a) Create extension class
  ```php
      namespace App\Extensions;
      use MyMvc\Extensions\FWExtension as Extension;
      
      class TestExtension extends Extension
      {
          //This method is called after all extensions have been registered. 
          public function boot()
          {
              
          }
          public function register()
          {
              $this->container()->bind(Abstract::class, Implementation::class);
              //\Closure 
              $this->container()->bind(AnotherAbstractClass::class,function ($container){
                 return new class implements AnotherAbstractClass{
                     public function method()
                     {
                         //TODO
                     }
                 };
              });
          }
      }
  ```
b) Register extension in /configs/extensions.php
  ```php
    return [
      \App\Extension\TestExtension::class
    ];
  ```
  
Example Controller class:
  ```php
   namespace App\Controllers;
   
   use App\Extensions\TestExtension;
   use MyMvc\Response\Response;
   
   class ExampleController extends Controller
   {
      /*
        /routes/web.php
        $router->bind('GET','/hello/{$id}','\App\Controllers\ExampleController@index');
      */
      public function index($id)
      {
        return new Response("Hello: $id");
      }
      
      /*
        /routes/web.php
        $router->bind('GET','/helloDI/{$var}','\App\Controllers\ExampleController@DITest');
      */
      public function DITest(\App\SomeClass $someClass)
      {
        return new Response("Test DI container");
      }
   }
  ```
