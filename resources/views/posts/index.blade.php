@extends('components.layout')


@section('content')

    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6 ">

    @if($posts->count()==0)

        <h1>No posts yet... Come back soon</h1>

        @else
            <div class="lg:grid lg:grid-cols-6" x-init @ajax:before="confirm('Are you sure?') || $event.preventDefault()">
            <x-post-card-large :post="$posts->first()" class="col-span-6"/>
            @foreach($posts->skip(1) as $post)

                @if($loop->iteration < 3)

                 <x-post-card-medium :post="$post" class="col-span-3"/>

                        @else

                        <x-post-card-small :post="$post" class="col-span-2"/>

                        @endif
            @endforeach
        @endif
            </div>
            {{$posts->links()}}
    </main>
{{--    <div class="lg:grid lg:grid-cols-2">--}}
{{--        <x-post-card-medium/>--}}
{{--        <x-post-card-medium/>--}}
{{--    </div>--}}

{{--    <div class="lg:grid lg:grid-cols-3">--}}
{{--        <x-post-card-small/>--}}
{{--        <x-post-card-small/>--}}
{{--        <x-post-card-small/>--}}
{{--    </div>--}}
{{--    </main>--}}
    {{--    @foreach ($posts as $post)--}}
{{--        <article>--}}
{{--            <h1>--}}
{{--                <a href="/posts/{{$post->slug}}">--}}
{{--                    {{$post->title}}--}}
{{--                </a>--}}
{{--            </h1>--}}
{{--            By <a href="/author/{{$post->author->username}}">{{$post->author->name}}</a> In--}}
{{--            <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>--}}
{{--            <div>{{$post->excerpt}}</div>--}}
{{--        </article>--}}
{{--    @endforeach--}}

@endsection
