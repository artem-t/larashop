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
                    <td>{{ mb_strimwidth($category->description, 0, 100, ' ...' ) }}</td>
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
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form method="post" action="{{ route('importCategories') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <input class="form-control-file" type="file" name="import-file">
            <button class="btn btn-outline-primary my-3">Загрузить</button>
            </div>
        </form>
        <form method="post" action="{{ route('exportCategories') }}">
            @csrf
            <button type="submit" class="btn btn-outline-primary my-3">Выгрузить</button>
        </form>

        <div>
            <ul class="list-group">
                @foreach($files as $file)
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
        {{ $categories->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection


