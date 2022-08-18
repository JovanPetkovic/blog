<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search','category', 'author']))
                ->paginate(5)->withQueryString()
        ]);
    }
    public function show($post){
        return view('post.show', [
            'post' => $post
        ]);
    }
}
