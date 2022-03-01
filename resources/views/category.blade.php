@extends('layouts.app')

@section('styles')
<style>
    .product-price {
        border-bottom: 1px solid grey;
        font-size: 23px;
        text-align: center;
        margin-bottom: 10px;
    }
    .card-text {
        height: 46px;
    }
    .product-buttons {
        display: flex;
        justify-content: space-between;
        line-height: 37px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row d-flex">
        @foreach ($products as $product)
        <div class="col">
            <div class="card mb-4 h-100" style="width: 18rem;">
                <div class="p-3"><img style="height: 10rem" src="{{ asset('storage') }}/{{$product->picture}}" class="card-img-top"
                        alt="{{$product->name}}"></div>
                <div class="card-body d-flex flex-column justify-content-between ">
                    <h5 class="card-title">
                        {{$product->name}}
                    </h5>
                    <p class="card-text">
                        {{ mb_strimwidth($product->description, 0, 70, ' ...') }}
                    </p>
                    <div class="product-price my-3">
                        {{ $product->price }} руб.
                    </div>
                    <div class="product-buttons">
                        <form method="post" action="{{ route('removeFromCart') }}">
                            @csrf
                            <input name='id' hidden value="{{ $product->id }}">
                            <button @empty(session("cart.$product->id")) disabled @endempty class="btn btn-danger">-</button>
                        </form>
                        {{ session("cart.$product->id") ?? 0 }}
                        <form method="post" action="{{ route('addToCart') }}">
                            @csrf
                            <input name='id' hidden value="{{ $product->id }}">
                            <button class="btn btn-success">+</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $products->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection
