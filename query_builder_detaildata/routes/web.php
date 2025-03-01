<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function(){
    return "Hello World";
});

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/{id}/detail', [BlogController::class, 'show'])->name('blog.show');