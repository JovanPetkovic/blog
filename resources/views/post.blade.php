@extends('layout')

@section('content')

    <article>
        <div>{!!$post->body!!} </div>
        <a href="/">Go Back</a>
    </article>

@endsection
