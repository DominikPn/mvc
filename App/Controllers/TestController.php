<?php
/**
 * Created by PhpStorm.
 * User: DesktopHome
 * Date: 2018-03-28
 * Time: 18:04
 */

namespace App\Controllers;


use App\TestInterface;
use TinyMvc\Response\Response;

class TestController extends Controller
{
    public function index()
    {
        return new Response( 'gf' );
    }
}