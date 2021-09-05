@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($allProducts as $product)
        <div class="col-sm-3">
            <div class="card">
                <img src="{{ asset('images/product' . '/' . $product->file) }}" alt="" class="card-img-top">
                <div class="card-body">
                    <div class="card-title"><strong>{{ $product->name }}</strong></div>
                    <div class="card-text">Harga : Rp. {{ number_format($product->price) }}</div>
                    <div class="row mt-3">
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
@endsection
