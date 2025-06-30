<?php
namespace App\Controllers;

use Yelarys\Framework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        return new Response("Добро пожаловать!", 200);
    }
}
