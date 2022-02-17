@extends('layouts.app')
@section('title')
    Добавить категорию
@endsection
@section('content')
    <h1>
        Добавить категорию
    </h1>
    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Имя категории</label>
            <input type="text" name="name" placeholder="Имя категории">
            <label for="description">Описание категории</label>
            <input type="text" name="description" placeholder="Описание категории">
            <label for="price">Цена</label>
            <input type="text" name="price" placeholder="Цена">
            <label for="picture">Изображение категории</label>
            <input type="file" name="picture" placeholder="Изображение категории">
            <select name="category_id" id="">
                @foreach($categories as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Сохранить</button>
    </form>
@endsection
