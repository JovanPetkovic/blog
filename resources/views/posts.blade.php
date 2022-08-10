@extends('layout')


@section('content')
     @foreach ($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{$post->slug}}">
                    {{$post->title}}
                </a>
            </h1>
            By <a href="/author/{{$post->author->username}}">{{$post->author->name}}</a> In
            <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
            <div>{{$post->excerpt}}</div>
        </article>
     @endforeach

@endsection
