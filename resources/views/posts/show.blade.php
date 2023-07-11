@extends('components.layout')


@section('content')

    @include('posts._header')
    <x-post-page :post="$post"/>
@endsection
