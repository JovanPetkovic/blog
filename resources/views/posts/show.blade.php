@extends('components.layout')

@include('posts._header')

@section('content')

    <x-post-page :post="$post"/>

@endsection
