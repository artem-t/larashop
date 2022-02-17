@extends('layouts.app')
@section('title')
    Добавить продукт
@endsection
@section('content')
    <h1>
        Добавить продукт
    </h1>
    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <select name="category_id" id="">
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            <label for="name">Имя продукта</label>
            <div><input type="text" name="name" placeholder="Имя продукта"></div>
            <label for="description">Описание продукта</label>
            <div><textarea type="text" name="description" placeholder="Описание продукта"></textarea></div>
            <label for="price">Цена</label>
            <div><input type="text" name="price" placeholder="Цена"></div>
            <label for="picture">Изображение продукта</label>
            <div><input type="file" name="picture" placeholder="Изображение продукта"></div>

        </div>
        <button type="submit">Сохранить</button>
    </form>
@endsection
