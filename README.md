# mvc
<h1>PHP MVC framework.</h1> 

<h2>Features:</h2>
 - beautiful URLs<br/>
 - dependency injection container<br/>
 - route parameters<br/>

<h2>Creating routes example:</h2>

```php
    //Define in /routes/web.php
  
    $router->bind('GET', '/', '\App\Controllers\TestController@index');
    //Adding route parameter
    $router->bind('GET', '/user/{id}', '\App\Controllers\TestController@showUserInfo');
    //Set route name
    $router->bind('POST','/welcome', '\App\Controllers\AnotherController@welcome')->name('welcomPage'); 
 ```
  
<h2>Register bindings in the container:</h2>
  
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
  
<h2>Example Controller class:</h2>

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


<h2>Adding <b>Twig template engine</b>. Create simple wrapper</h2>
 a) Install TWIG and create two folders '/templates','/twigCache'
 
 ``` bash
 composer require "twig/twig:^2.0"
 ```
 
 b) Create classes
 
 ```php
    namespace App\Helpers;

    interface View
    {
     public function render(string $path, array $data);
    }
 ```
 
 ```php
 namespace App\Helpers;

 class ViewImpl implements View
 {

     private $twig;

     public function __construct($twig)
     {
         $this->twig = $twig;
     }

     public function render(string $path, array $data = []){
             $template = $this->twig->load($path);
             return $template->render($data);
     }
 }
 ```
 
 c) Create and register extension
 
  ```php
  namespace App\Extensions;

  use MyMvc\Extensions\FWExtension as Extension;
  use App\Helpers\View;
  use App\Helpers\ViewImpl;

  class ViewExtension extends Extension
  {
      public function boot()
      {

      }

      public function register()
      {
          $loader = new \Twig_Loader_Filesystem('../templates');
          $twig = new \Twig_Environment($loader, array(
              'cache' => '../twigCache',
          ));

          $this->container()->bind(View::class, function () use ($twig){
              $viewImpl = new ViewImpl($twig);

              return $viewImpl;
          });
      }
  }
 ```
 
 d) Now you cen use ViewHelper in Controllers
 
  ```php
    namespace App\Controllers;
    
    use App\Helpers\View;
    
    class SomeController
    {
         private $view;
	 
         public function __construct(View $viewHelper)
         {
             $this->view = $viewHelper;
         } 
	 
         public function twig()
         {
             return new Response($this->view->render('yourTemplateInTemplatesFolder.html',['name'=>'John']));
	 }
    }
 ```
 
 ```php
    //yourTemplateInTemplatesFolder.html file
    <b>Hello {{ name }}</b>
 ```


<h2>Request Lifecycle:</h2>

 Index.php -> create Request, Router, Container, ControllerResolver and register URLs 
  -> create Kernel: inject Router, Container, ControllerResolver, Config 
   -> load extensions
    -> create Response by calling execute() method on Kernel 
     -> send Response
