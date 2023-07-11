<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use MarkSitko\LaravelUnsplash\Unsplash;

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

    public function savePost(){
        request()->validate([
            'title' => ['required'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'category' => ['required']
        ]);
        $unsplash = new Unsplash();
        $user_id = auth()->user()->id;
        $picture_url = $unsplash->randomPhoto()
            ->orientation('landscape')
            ->term('programming')->toCollection()['urls']['regular'];

        $post = new Post;

        $post = Post::create([
            'author_id' => $user_id,
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body'),
            'category_id' => request('category'),
            'img_url' => $picture_url,
            'slug' => fake()->slug
        ]);

    }

    public function delete($postSlug){
        $post = Post::where('slug', $postSlug)->get()->first();
        $post->delete();
    }
}
