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

    <form method="post" action="{{ route('saveProfile') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $user->id }}" name='userId'>
        <div class="mb-3">
            <label class="form-label">Изображение</label>
            <image class="user-picture mb-2" src="{{asset('storage')}}/{{$user->picture}}"></image>
            <input type="file" name="picture" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Почта</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input name="name" value="{{ $user->name }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Текущий пароль</label>
            <input type="password" autocomplete="off" name="current_password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Новый пароль</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Повторите новый пароль</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Список адресов</label>
            @forelse ($user->addresses as $address)
                <br>
                <label for="main_address{{$address->id}}">{{$address->address}}</label>
                <input @if ($address->main) checked @endif id="main_address{{$address->id}}" name='main_address'
                       type="radio" value="{{$address->id}}">
            @empty
                <em>Ку-ку)</em>
            @endforelse
        </div>
        <div class="mb-3">
            <label class="form-label">Новый адрес</label>
            <input name="new_address" class="form-control">
            {{--            @if(!$user->addresses)--}}
            <input name="main_address" type="checkbox">
            {{--            @endif--}}
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
    <div>


        {{--                    <td>{{ $order->id }}</td>--}}


        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Prod</th>
                <th scope="col">date</th>
                <th scope="col">date</th>
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
                            <button type="submit">Повторить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
