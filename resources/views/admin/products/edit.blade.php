@extends('layouts.app')
@section('title')
    Редактировать {{ $product->name }}
@endsection
@section('content')
    <h1>
        Редактировать {{ $product->name }}
    </h1>
    <form method="post" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex-column w-50">
            <div class="form-group">
            <select class="form-control" name="category_id" id="">
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}"  @if($key === $product->category_id) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group my-3">
            <label for="name">Имя продукта</label>
            <input class="form-control" type="text" name="name" value="{{ $product->name }}">
            </div>
            <div class="form-group my-3">
            <label for="description">Описание продукта</label>
            <input class="form-control" type="text" name="description" value="{{ $product->description }}">
            </div>
            <div class="form-group my-3">
            <label for="price">Цена</label>
            <input class="form-control" type="text" name="price" value="{{ $product->price }}">
            </div>
            <div class="form-group my-3">
            <label for="picture">Изображение продукта</label>
           <input class="form-control" type="file" name="picture" placeholder="Изображение продукта">
            </div>
            <div><img style="height: 150px" src="{{asset('storage')}}/{{ $product->picture }}" alt=""></div>

        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
@endsection
