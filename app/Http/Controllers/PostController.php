<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        $post = new Post();

        $post->author_id = $user_id;
        $post->title = request('title');
        $post->excerpt = request('excerpt');
        $post->body = request('body');
        $post->category_id = request('category');
        $post->img_url = $picture_url;
        $post->slug = fake()->slug;

        $post->save();

        return route('home');

    }

    public function delete($postSlug){
        $post = Post::where('slug', $postSlug)->get()->first();
        $post->delete();
    }

    public function getAllAPI(){
        $posts = Post::all();
        $posts_array = array();
        if (!$posts) {
            return response()->json(['error' => "We couldn't retrieve data about posts. Please try again later."],
                Response::HTTP_NOT_FOUND);
        }
        foreach($posts as $post){
            $post_json = array(
                'title' => $post->title,
                'slug' => $post->slug,
                'author' => $post->author->name,
                'category'=> $post->category->name
            );
            array_push($posts_array,$post_json);
        }

        $jsonObject = json_encode($posts_array);

        return $jsonObject;
    }

    public function getAPI($slug){
        $post = Post::where('slug',$slug)->get()->first();
        if (!$post) {
            return response()->json(['error' => "Post under that slug doesn't exist."],
                Response::HTTP_NOT_FOUND);
        }
        $post_json = array(
            'title' => $post->title,
            'slug' => $post->slug,
            'author' => $post->author->name,
            'category'=> $post->category->name,
            'text' => $post->body
        );
        $jsonObject = json_encode($post_json);
        return $jsonObject;
    }

    public function storeAPI(){

    }

    public function deleteAPI(Request $request, $slug){

        $apiToken = $request->bearerToken();
        $user = User::where('api_token',$apiToken)->get()->first();
        if($user->role!=1){
            return response()->json(['error' => 'Invalid admin token'],Response::HTTP_UNAUTHORIZED);
        }
        $post = Post::where('slug',$slug)->get()->first();
        if (!$post) {
            return response()->json(['error' => "Post under that slug doesn't exist."],
                Response::HTTP_NOT_FOUND);
        }

        $post->delete();

        return response()->json(['message'=>'Post deleted successfully.'],Response::HTTP_OK);
    }
}
