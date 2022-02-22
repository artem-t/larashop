@extends('layouts.app')

@section('title')
    Список пользователей
@endsection

@section('content')

    @if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{$error}}
                @if (!$loop->last)<br> @endif
            @endforeach
        </div>
    @endif
    <user-component>

    </user-component>

    <h1>PHP</h1>
    <h1>Список ролей</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $idx => $role)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td>{{$role->name}}</td>
                <td> <form method="post" action="{{ route('rmRole', ['id' => $role->id])  }}">
                        @csrf
                        <input type="text" hidden name="name" value="{{ $role->name }}">
                        <button class="btn btn-outline-danger align-text-top" type="submit">Удалить</button>
                    </form></td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="2">Ролей пока нет</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <form method="post" action="{{route('addRole')}}" class="mb-4">
        <h3>Добавить новую роль</h3>
        @csrf
        <input class="form-control mb-2" name='name'>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>

    <form method="post" action="{{route('addRoleToUser')}}" class="mb-4">
        <h3>Добавить роль пользователю</h3>
        @csrf
        <select class="form-control mb-2" name='user_id'>
            <option disabled selected>-- Выберите пользователя --</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <select class="form-control mb-2" name='role_id'>
            <option disabled selected>-- Выберите роль --</option>
            @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>

    <h1>
        {{ $title }}
    </h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Почта</th>
                <th>Роли</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="tab-content">
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <ul>
                            @foreach ($user->roles as $role)
                                <li class="d-flex justify-content-between align-content-center m-0">
                                    <div class="m-auto">{{$role->name}}</div>
                                    <div>
                                         <form method="post" action="{{ route('rmRoleToUser')  }}">
                                        @csrf
                                        <input type="text" hidden name="user_id" value="{{ $user->id }}">
                                        <input type="text" hidden name="role_id" value="{{ $role->id }}">
                                        <button class="btn btn-link red align-text-top" type="submit">Удалить</button>
                                    </form>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{ route('enterAsUser', $user->id) }}">Войти</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links('vendor.pagination.bootstrap-4') }}
@endsection
