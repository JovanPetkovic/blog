<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /*Ova funkcija sluzi za vracanje post.index view-a zajedno sa listom
    postova sortiranim od najskorijeg posta i koristeci url prametre search
    category i author. Koristi se za pocetnu stranu*/
    public function index(){

        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search','category', 'author']))
                ->paginate(6)->withQueryString()
        ]);
    }
    /*Koristi se za prikazivanje clanka na blogu. Klikom ne read more poziva se API koji
    poziva ovu funkciju i prosledjuje parametar $postSlug uz pomoc kojeg se nalazi post. */
    public function show($postSlug){
        return view('posts.show', [
            'post' => Post::where('slug', $postSlug)->get()->first()
        ]);
    }
    /**/
    public function create(){
        return view('posts.create');
}
}
