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

        $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);

        return back();
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
}
