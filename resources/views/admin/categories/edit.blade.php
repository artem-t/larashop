@extends('layouts.app')
@section('title')
    Добавить категорию
@endsection
@section('content')
    <h1>
        Добавить категорию
    </h1>
    <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Имя категории</label>
            <input type="text" name="name" value="{{ $category->name }}">
            <label for="description">Описание категории</label>
            <input type="text" name="description" value="{{ $category->description }}">
            <label for="picture">Изображение категории</label>
            <input type="file" name="picture" placeholder="Изображение категории">
            <img style="height: 50px" src="{{asset('storage')}}/{{ $category->picture }}" alt="">
        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
@endsection
