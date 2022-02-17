@extends('layouts.app')

@section('title')
    Админка
@endsection

@section('content')
    <a href="{{ route('adminUsers')}}">Список пользователей</a>
    <a href="{{ route('products.index')}}">Список продуктов</a>
    <a href="{{ route('categories.index')}}">Список категорий</a>
@endsection
