<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function(){
    return "Hello World";
});

Route::get('/blog', [BlogController::class, 'index']);