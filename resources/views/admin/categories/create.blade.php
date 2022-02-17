@extends('layouts.app')
@section('title')
    Добавить категорию
@endsection
@section('content')
    <h1>
        Добавить категорию
    </h1>
    <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Имя категории</label>
            <input type="text" name="name" placeholder="Имя категории">
            <label for="description">Описание категории</label>
            <input type="text" name="description" placeholder="Описание категории">
            <label for="picture">Изображение категории</label>
            <input type="file" name="picture" placeholder="Изображение категории">
        </div>
        <button type="submit">Сохранить</button>
    </form>
@endsection
