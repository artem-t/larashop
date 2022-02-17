@extends('layouts.app')

@section('title')
    Админка
@endsection

@section('content')
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('adminUsers')}}">Список пользователей</a>
            <a class="nav-link active" href="{{ route('products.index')}}">Список продуктов</a>
            <a class="nav-link active" href="{{ route('categories.index')}}">Список категорий</a>
        </li>
    </ul>
@endsection
