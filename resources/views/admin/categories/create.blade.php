@extends('layouts.app')
@section('title')
    Добавить категорию
@endsection
@section('content')
    <h1>
        Добавить категорию
    </h1>
    <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex-column w-50">
            <div class="form-group my-3">
            <label for="name">Имя категории</label>
            <input class="form-control" type="text" name="name" placeholder="Имя категории">
            </div>
            <div class="form-group my-3">
            <label for="description">Описание категории</label>
            <input class="form-control" type="text" name="description" placeholder="Описание категории">
            </div>
            <div class="form-group my-3">
            <label  for="picture">Изображение категории</label>
            <input class="form-control" type="file" name="picture" placeholder="Изображение категории">
            </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
    </form>

@endsection
