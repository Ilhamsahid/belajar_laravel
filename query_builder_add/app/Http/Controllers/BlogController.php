<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    function index(Request $request){
        $title = $request->title;

        $blogs = DB::table('blogs')->where('title', 'LIKE', "%$title%")->orderBy('id', 'desc')->Paginate(10);

        return view('blog', ['data' => $blogs, 'title' => $title]);
    }

    function store(Request $request){
        $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'description' => 'required',
        ]);

        DB::table('blogs')->insert([
            'title' => $request->title,
            'description' => $request->description
        ]);

        Session::flash('message', 'New Blog Succesfully Added');

        return response()->json(['success' => true]);
    }
}