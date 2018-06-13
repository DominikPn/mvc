<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 18:04
 */

namespace App\Controllers;
use App\TestInterface;
use App\TestClass;
use App\TestInterface2;
use MyMvc\Response\Response;

class TestController extends Controller
{
    public function index()
    {

        return new Response( 'Testowy kontroler');
    }
	
	public function metodaZeZmienna($zmienna)
	{
		return new Response('Wartosc $zmienna: '.$zmienna);
	}
	
	public function metodaZeZmienna2($zmienna,$zmienna2)
	{
		return new Response('Wartosc $zmienna: '.$zmienna.'<br>'.'Wartosc $zmienna: '.$zmienna2 );
	}
	
	public function containerTest($jakasWartosc,TestClass $test)
	{
		
		return new Response('Wartosc $zmienna: '.$jakasWartosc.'<br>'.$test->testMetoda());
	}
	
	public function containerBindingTest(TestInterface $test, TestInterface2 $testInterface2)
	{
		return new Response($test->testMetoda() .'<br><br>'.$testInterface2->metodaTestInterface2());
	}
}