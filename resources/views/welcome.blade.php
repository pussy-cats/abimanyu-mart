@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="jumbotron jumbotron-fluid mt-0"
    style="background-image: url('https://images.unsplash.com/photo-1568332620171-160b4bdca2e1'); background-size: cover; background-position: center; height: 400px">
</div>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Produk Terbaru</h2>
    <div class="row">
        @foreach($newProducts as $product)
        <div class="col-sm-3">
            <div class="card">
                <img src="{{ asset('/images/product' . '/' . $product->file) }}" alt="" class="card-img-top"
                    height="200px">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                    <div class="row">
                        <div class="col-sm-auto">
                            <a href="{{ route('productGuestDetail', ['id' => $product->id]) }}"
                                class="btn btn-info">Detail</a>
                        </div>
                        <div class="col-sm-auto">
                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="btn btn-primary">+
                                Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Produk Terlaris</h2>
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30" alt="" class="card-img-top"
                    height="200px">
                <div class="card-body">
                    <p>Test</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e" alt="" class="card-img-top"
                    height="200px">
                <div class="card-body">
                    <p>Test</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b55e" alt="" class="card-img-top"
                    height="200px">
                <div class="card-body">
                    <p>Test</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" alt="" class="card-img-top"
                    height="200px">
                <div class="card-body">
                    <p>Test</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
