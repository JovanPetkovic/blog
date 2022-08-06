@extends('layout')


@section('content')
     @foreach ($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{$post->slug}}">
                    {{$post->title}}
                </a>
            </h1>
            <div>{{$post->excerpt}}</div>
            <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </article>
     @endforeach

@endsection
