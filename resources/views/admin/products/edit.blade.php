@extends('layouts.app')
@section('title')
    Добавить категорию
@endsection
@section('content')
    <h1>
        Добавить категорию
    </h1>
    <form method="post" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Имя категории</label>
            <input type="text" name="name" value="{{ $product->name }}">
            <label for="description">Описание категории</label>
            <input type="text" name="description" value="{{ $product->description }}">
            <label for="price">Цена</label>
            <input type="text" name="price" value="{{ $product->price }}">
            <label for="picture">Изображение категории</label>
            <input type="file" name="picture" placeholder="Изображение категории">
            <img style="height: 50px" src="{{asset('storage')}}/{{ $product->picture }}" alt="">
            <select name="category_id" id="">
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}"  @if($key === $product->category_id) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
@endsection
