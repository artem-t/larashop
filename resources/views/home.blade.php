@extends('layouts.app')

@section('content')

    {{--@auth--}}
    {{--Вы вошли!--}}
    {{--@endauth--}}

<div class="container">
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-3">
            <div class="card mb-4" style="width: 18rem; ">
                <div class="p-3"><img src="{{ asset('storage') }}/{{$category->picture}}" style="height: 10rem" class="card-img-top"
                        alt="{{$category->name}}"></div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$category->name}}
                    </h5>
                    <p class="card-text">
                        {{ $category->description }}
                    </p>
                    <a href="{{ route('category', $category->id) }}" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    {{ $categories->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection
