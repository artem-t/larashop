@extends('layouts.app')

@section('title')
    Список продуктов
@endsection

@section('content')
    <h1>
        Список продуктов
    </h1>
    <div>
        <a class="btn btn-success" href="{{ route('products.create') }}">Добавить товар</a>
    </div>
    <hr>
    <div>
        <ul class="nav">
            @foreach($categories as $category)
{{--                @dd($category)--}}
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
                </li>
            @endforeach

            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
    </div>
<div class="d-flex flex-wrap">
    @foreach($products as $product)
    <div class="card m-2" style="width: 18rem;">
        <div class="p-3 h-50">
            <img class="card-img-top h-100" src="{{asset('storage')}}/{{ $product->picture }}" alt="Card image cap">
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Редактировать</a>
        </div>
    </div>

    @endforeach
    {{ $products->links() }}

@endsection
