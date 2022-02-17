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
        <div class="col-2">
            <select name="category_id" id="">
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}"  @if($key === $product->category_id) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
            <label for="name">Имя продукта</label>
            <div><input type="text" name="name" value="{{ $product->name }}"></div>
            <label for="description">Описание продукта</label>
            <div><input type="text" name="description" value="{{ $product->description }}"></div>
            <label for="price">Цена</label>
            <div><input type="text" name="price" value="{{ $product->price }}"></div>
            <label for="picture">Изображение продукта</label>
            <div><input type="file" name="picture" placeholder="Изображение продукта"></div>
            <div><img style="height: 150px" src="{{asset('storage')}}/{{ $product->picture }}" alt=""></div>

        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
@endsection
