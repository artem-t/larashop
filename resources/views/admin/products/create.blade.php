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
        <div class="flex-column w-50">
            <div class="form-group">
            <select class="form-control my-3" name="category_id" id="">
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group my-3">
            <label for="name">Имя продукта</label>
           <input class="form-control" type="text" name="name" placeholder="Имя продукта">
            </div>
            <div class="form-group my-3">
            <label for="description">Описание продукта</label>
            <textarea class="form-control" type="text" name="description" placeholder="Описание продукта"></textarea>
            </div>
            <div class="form-group my-3 my-3">
            <label for="price">Цена</label>
            <input class="form-control" type="text" name="price" placeholder="Цена">
            </div>
            <div class="form-group my-3">
            <label for="picture">Изображение продукта</label>
            <input class="form-control" type="file" name="picture" placeholder="Изображение продукта">
            </div>

        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
@endsection
