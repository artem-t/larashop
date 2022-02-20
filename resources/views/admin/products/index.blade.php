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
                    <a class="nav-link active"
                       href="{{ route('categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="d-flex row">
        @foreach($products as $product)
            <div class="card m-2" style="width: 18rem;">
                <div class="p-3 h-50">
                    <img class="card-img-top h-100" src="{{asset('storage')}}/{{ $product->picture }}"
                         alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <div class="d-flex">
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Редактировать</a>
{{--                        <form class="mx-3 h-100" method="post"--}}
{{--                              action="{{ route('products.destroy', ['product' => $product->id]) }}">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button class="btn btn-danger " type="submit"--}}
{{--                                    onclick="return confirm('Подтвердить удаление')">Удалить--}}
{{--                            </button>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>

    @endforeach
    {{ $products->links() }}

@endsection
