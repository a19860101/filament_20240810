<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index(){
        $posts = Post::orderBy('id','DESC')->get();
        return view('post.index',compact('posts'));
    }
}
