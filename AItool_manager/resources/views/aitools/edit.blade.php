@extends('layout')

@section('content')

@error('name')
<div class='alert alert-warning'>{{ $message }}</div>
@enderror

@error('description')
<div class='alert alert-warning'>{{ $message }}</div>
@enderror

@error('price')
<div class='alert alert-warning'>{{ $message }}</div>
@enderror

<form action="{{ route('aitools.update', $aitool->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="name">Név</label>
        <input type="text" name="name" id="name" value="{{ old('name', $aitool->name) }}">
    </fieldset>
    <fieldset>
        <label for="name">Kategória</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $aitool->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="name">Leírás</label>
        <textarea name="description" id="description">{{ old('description', $aitool->description) }}</textarea>
    </fieldset>
    <fieldset>
        <label for="name">Ár (havonta Ft-ban)</label>
        <input type="number" name="price" id="price" value="{{ old('price', $aitool->price) }}">
    </fieldset>
    <button type="submit">Ment</button>
</form>

@endsection