@extends('layout')

@section('content')

<h1>{{ $aitool->name }} {{ $aitool->hasFreePlan ? '✅' : '❌' }}</h1>
<h2>Kategória: {{ $aitool->category->name }}</h2>

<p>{{ $aitool->description }}</p>
<a href="{{$aitool->link}}">{{$aitool->link}}</a>
<small>{{$aitool->price}}</small>

<ul class="tags">
    @foreach ($aitool->tags as $tag)
        <li>{{$tag->name}}</li>
    @endforeach
</ul>
@endsection