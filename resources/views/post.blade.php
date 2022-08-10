@extends('layout')

@section('content')

    <article>
        <h1>{{ $post->title }}</h1>
        By <a href="/author/{{$post->author->username}}">{{$post->author->name}}</a> in
        <a href="/category/{{$post->category->slug}}">{{$post->category->name}}</a>
        <div>{!!$post->body!!} </div>
        <a href="/">Go Back</a>
    </article>

@endsection
