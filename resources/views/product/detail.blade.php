@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container mt-5">
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset('images/product' . '/' . $productData->file) }}" alt="..." width="100%"
                    height="100%">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $productData->name }}</h5>
                    <p class="card-text">
                        <dl class="row">
                            <dt class="col-sm-3">Harga</dt>
                            <dd class="col-sm-9">Rp. {{ number_format($productData->price) }}</dd>
                            <dt class="col-sm-3">Stok</dt>
                            <dd class="col-sm-9">{{ number_format($productData->stock) }} Item</dd>
                            <dt class="col-sm-3">Deskripsi Barang</dt>
                            <dd class="col-sm-9">{!! $productData->description !!}</dd>
                        </dl>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
