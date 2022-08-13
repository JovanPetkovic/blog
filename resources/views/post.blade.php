@extends('components.layout')

@include('_post-header')

@section('content')

    <x-post-page :post="$post"/>

@endsection
