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
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Редактировать</a>
                        <form method="post" action="{{ route('products.destroy', ['product' => $product->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Удалить</button>
                        </form>

                    </div>
                </div>
            </div>

    @endforeach
{{--            @dd($exportCategories)--}}
            <form method="post" action="{{ route('exportProducts') }}" enctype="multipart/form-data">
                @csrf
                <select name="category_id" id="">

                    @foreach($exportCategories as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach

                </select>
                <button type="submit" class="btn btn-outline-primary my-3">Выгрузить</button>
            </form>
            <div>
                <ul class="list-group">
                    @foreach($productFiles as $file)
                        <li class="list-group-item d-flex align-items-center">
                            <div style="height: 25px">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-100 w-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                            <a class="btn btn-link" href="{{ asset('storage') }}/{{$file}}">{{basename($file)}}</a>
                        </li>
                    @endforeach
                </ul>

            </div>
    {{ $products->links() }}

@endsection
