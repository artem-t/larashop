@extends('layouts.app')
@section('title')
    Редактировать категорию {{ $category->name }}
@endsection
@section('content')
    <h1>
        Редактировать категорию {{ $category->name }}
    </h1>
    <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex-column w-50">
            <div class="form-group my-3">
            <label for="name">Имя категории</label>
            <input class="form-control" type="text" name="name" value="{{ $category->name }}">
            </div>
            <div class="form-group my-3">
            <label for="description">Описание категории</label>
            <input class="form-control" type="text" name="description" value="{{ $category->description }}">
            </div>
            <div class="form-group my-3">
            <label for="picture">Изображение категории</label>
            <input class="form-control" type="file" name="picture" placeholder="Изображение категории">
            </div>
            <div class="img-fluid my-3">
            <img style="height: 150px" src="{{asset('storage')}}/{{ $category->picture }}" alt="">
            </div>
        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
@endsection
