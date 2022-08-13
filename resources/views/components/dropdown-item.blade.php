@props(['active' => false])

@php
    $class = "pl-3 w-full hover:bg-blue-500 px-2";
    if($active) $class = "bg-blue-500 " . $class;

@endphp


<a {{$attributes(['class'=> $class])}}>{{$slot}}</a>
