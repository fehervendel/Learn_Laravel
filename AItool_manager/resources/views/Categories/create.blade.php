@extends('layout')

@section('content')

<h1>Új kategória</h1>

@error('name')
<div class='alert alert-warning'>{{ $message }}</div>
@enderror

<form action="{{ route('categories.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="name">Kategória név</label>
        <input type="text" name="name" id="name">
    </fieldset>
    <button type="submit">Ment</button>
</form>
@endsection