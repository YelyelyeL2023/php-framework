<?php
use App\Controllers\HomeController;
use App\Controllers\PostController;
use Yelarys\Framework\Routing\Route;

return[
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id:\d+}', [PostController::class, 'show'])

];