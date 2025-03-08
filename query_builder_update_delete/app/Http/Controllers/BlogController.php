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

    function show($id){
        $blog = DB::table('blogs')->where('id', $id)->first();

        if (!$blog){
            abort(404);
        }

        return view('blog-detail', ['blog' => $blog]);
    }

    function update(Request $request, $id){
        $request->validate([
            'title' => 'required|unique:blogs,title,'.$id.'|max:255',
            'description' => 'required',
        ]);

        DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        Session::flash('message', 'Blog Succesfully Updated');

        return response()->json(['success' => true]);
    }

    function getBlogById($id){
        $blog = DB::table('blogs')->where('id', $id)->first();

        if(!$blog){
            return response()->json(['error' => 'data not found', 404]);
        }

        return response()->json($blog);
    }

    function destroy($id){
        DB::table('blogs')->where('id', $id)->delete();

        Session::flash('message', 'Blog Succesfully Delete');

        return redirect(route('blog.index'));
    }
}