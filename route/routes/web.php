<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function(){
    return "Hello World";
});

Route::get('/tambah', function () {
    $a = 6;
    $b = 7;
    $c = $a + $b;
    return "Hasil dari dari $a + $b adalah $c";
});

// Route::get('/blog', function () {
//     $nama = "Ilham";
//     return view('blog', ['nama' => $nama]);
// })->name('blog');

Route::get('/blog', [BlogController::class, 'index']);

// Route::view('/blog', 'blog', ['nama' => 'Ilham']);

Route::get('/blog/{id}', function (Request $request) {
    // return "Ini adalah blog $request->id";
    //Anggap menguodate data dan berhasil
    return redirect()->route('blog');
});