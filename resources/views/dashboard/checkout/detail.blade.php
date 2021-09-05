@extends('adminlte::page')

@section('title', 'Detail Belanja')

@section('content_header')
<h1 class="m-0 text-dark">Detail Belanja - {{ $checkoutData->user->name }} -
    {{ \Carbon\Carbon::parse($checkoutData->created_at)->toFormattedDateString() }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">Detail Pengiriman</div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-12 text-center mb-3">Data Pemesan</dt>
                    <dt class="col-sm-5">Nama Pemesan : </dt>
                    <dd class="col-sm-7">{{ $checkoutData->user->name }}</dd>
                    <dt class="col-sm-5">Email Pemesan : </dt>
                    <dd class="col-sm-7">{{ $checkoutData->user->email }}</dd>
                    <dt class="col-sm-12 text-center mb-3 mt-3">Data Pengiriman</dt>
                    <dt class="col-sm-5">Kurir Pengiriman : </dt>
                    <dd class="col-sm-7">{{ strtoupper($checkoutData->courier) }}</dd>
                    <dt class="col-sm-5">Biaya Ongkir : </dt>
                    <dd class="col-sm-7">Rp. {{ number_format($checkoutData->deliveryfee) }}</dd>
                    <dt class="col-sm-5">Alamat Pengiriman : </dt>
                    <dd class="col-sm-7">{{ $checkoutData->address }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">Daftar Belanja</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Item</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($checkoutData->checkoutDetails as $checkoutDetail)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $checkoutDetail->cart->product->name }}</td>
                            <td>Rp. {{ number_format($checkoutDetail->cart->product->price) }}</td>
                            <td>{{ $checkoutDetail->cart->quantity }} Item</td>
                            <td>Rp.
                                {{ number_format($checkoutDetail->cart->product->price * $checkoutDetail->cart->quantity) }}
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">Total</td>
                            <td>Rp. {{ number_format($checkoutData->checkoutDetails->sum('cart.product.price')) }}</td>
                            <td>{{ $checkoutData->checkoutDetails->sum('cart.quantity') }} Item</td>
                            <td>Rp. {{ number_format($checkoutData->total) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
