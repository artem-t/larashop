@extends('layouts.app')

@section('title')
    Профиль
@endsection

@section('styles')
    <style>
        .user-picture {
            width: 100px;
            border-radius: 100px;
            display: block;
        }

        .main-address {
            font-weight: bold;
        }
    </style>
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

    @if (session('profileSaved'))
        <div class="alert alert-success" role="alert">
            Профиль успешно сохранен!
        </div>
    @endif
<h1>
    Страница пользователя {{ $user->name }}
</h1>
    <form method="post" action="{{ route('saveProfile') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex-column">
        <input type="hidden" value="{{ $user->id }}" name='userId'>
        <div class="form-group my-3">
{{--            <label class="form-label">Изображение</label>--}}
            <image class="user-picture mb-2" src="{{asset('storage')}}/{{$user->picture}}"></image>
        </div>
        <div class="form-group my-3">
            <lable for="picture">Фото</lable>
            <input type="file" name="picture" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="exampleInputEmail1" class="form-label">Почта</label>
            <input readonly type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">{{ __('We\'ll never share your email with anyone else.') }}</div>
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Имя</label>
            <input name="name" value="{{ $user->name }}" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Текущий пароль</label>
            <input type="password" autocomplete="off" name="current_password" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Новый пароль</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Повторите новый пароль</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Список адресов</label>

                <ol>
                    @forelse ($user->addresses as $address)
                    <li>
                        <label @if ($address->main) class="form-check-label h5" @endif for="main_address{{$address->id}}">{{$address->address}}</label>
                        <input class="form-check-input" @if ($address->main) checked @endif id="main_address{{$address->id}}" name='main_address'
                               type="radio" value="{{$address->id}}">
                    </li>
                    @empty
                        <em>Нет адресов</em>
                    @endforelse
                </ol>


        </div>
        <div class="form-group mb-3">
            <label class="form-label">Новый адрес</label>
            <input name="new_address" class="form-control" placeholder="Введите новый адрес">
            {{--            @if(!$user->addresses)--}}
            <div class="form-check my-3">
                <lable class="form-check-label" for="main_address">Указать основным</lable>
                <input class="form-check-input" name="main_address" type="checkbox">
            </div>
            {{--            @endif--}}
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
    <div>


        {{--                    <td>{{ $order->id }}</td>--}}

<h2 class="my-3">История покупок</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заказ и количество</th>
                <th scope="col">Дата</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{ $id = $order->id }}</th>
                    <td>

                        @foreach($order->products as $product)


                            {{$product->name }} | Количество: {{ $product->pivot->quantity }} <br>


                        @endforeach</td>


                    <td>{{ $order->created_at }}</td>
                    <td>
                        <form method="post" action="{{ route('repeatToCart') }}" enctype="multipart/form-data">
                            <input type="text" hidden name="id" value="{{ $id }}">
                            @csrf
                            <button class="btn btn-primary" type="submit">Повторить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
