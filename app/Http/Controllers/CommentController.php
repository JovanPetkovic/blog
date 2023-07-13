<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate([
            'body'=> ['required']
        ]);

        $comment = $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);

        return view('components.post-comment' ,[
            'comment' => $comment
        ]);
    }

    public function edit($id){
        return view('components.post-comment-edit', [
           'comment' => Comment::where('id', $id)->get()->first()
        ]);
    }

    public function post($id)
    {
        request()->validate([
            'body' => ['required']
        ]);
        $comment = Comment::find($id);
        $comment->update([
            'body' => request('body')
        ]);
        return view('components.post-comment' ,[
            'comment' => $comment
        ]);
    }
    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }


    public function getAllAPI($slug){
        $post = Post::where('slug', $slug)->get()->first();
        if (!$post) {
            return response()->json(['error' => "Post under that slug doesn't exist."],
                Response::HTTP_NOT_FOUND);
        }
        $comments = $post->comments;
        if (!$comments) {
            return response()->json(['error' => "There are no comments for this post."],
                Response::HTTP_NOT_FOUND);
        }
        $comments_array = array();

        foreach($comments as $comment){
            $post_json = array(
                'comment' => $comment->body,
                'author' => $comment->author->name
            );
            array_push($comments_array,$post_json);
        }

        $jsonObject = json_encode($comments_array);

        return $jsonObject;
    }
}
