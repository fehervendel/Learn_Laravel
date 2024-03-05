@extends('layout')

@section('content')

<h1>Címkék</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<ul>
    @foreach($tags as $tag)
    <li class="actions">
        {{ $tag->name }}
        <a href="{{route('tags.show', $tag->id) }}" class="button">Megjelenítés</a>
        <a href="{{route('tags.edit', $tag->id) }}" class="button">Szerkesztés</a>
        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
            @csrf                @method('DELETE')
            <button type="submit" class="danger" onclick="return confirm('Biztos törölni akarja?')">Törlés</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection