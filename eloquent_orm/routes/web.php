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
Route::put('/blog/{id}/update', [BlogController::class, 'update'])->name('blog.update');
Route::get('/blog/data/{id}', [BlogController::class, 'getBlogById'])->name('blog.getBlogById');
Route::get('blog/{id}/delete', [BlogController::class, 'destroy'])->name('blog.delete');
Route::get('blog/{id}/restore', [BlogController::class, 'restore'])->name('blog.restore');