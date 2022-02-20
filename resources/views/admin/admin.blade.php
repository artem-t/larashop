@extends('layouts.app')

@section('title')
    Админка
@endsection

@section('content')

    <ul class="nav justify-content-center h4">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('adminUsers')}}">Список пользователей</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('products.index')}}">Список продуктов</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('categories.index')}}">Список категорий</a>
        </li>

    </ul>
@endsection
