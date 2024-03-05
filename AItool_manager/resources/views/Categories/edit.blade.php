@extends('layout')

@section('content')

@error('name')
<div class='alert alert-warning'>{{ $message }}</div>
@enderror

<form action="{{ route('categories.update', $category->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="name">Kategória név</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}">
    </fieldset>
    <button type="submit">Ment</button>
</form>

@endsection