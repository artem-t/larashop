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
    @foreach($products as $product)
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('storage')}}/{{ $product->picture }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Редактировать</a>
        </div>
    </div>
    @endforeach
    {{ $products->links() }}
</div>
@endsection
