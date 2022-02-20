@extends('layouts.app')

@section('title')
    Список категорий
@endsection

@section('content')
    <h1>
        Список категорий
    </h1>

    <div>
        <a class="btn btn-success" href="{{ route('categories.create') }}">Добавить категорию</a>
    </div>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                {{--                <th scope="col">Изображение</th>--}}
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id}}</th>
                    {{--                <td ><img style="height: 30px" src="{{asset('storage')}}/{{ $category->picture }}" alt=""></td>--}}
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td class="d-flex">
                        <a class="btn btn-outline-primary btn-sm"
                           href="{{ route('categories.edit', ['category' => $category->id]) }}">
                            Редактировать
                        </a>
                        <form class="mx-3" method="post"
                              action="{{ route('categories.destroy', ['category' => $category->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm " type="submit"
                                    onclick="return confirm('Подтвердить удаление')">Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection


