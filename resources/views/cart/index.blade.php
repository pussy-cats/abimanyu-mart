@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Data Keranjang <a href="{{ route('checkout.add') }}"
                class="btn btn-info float-right">Checkout</a></div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hovered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col" class="text-center" colspan="2">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allCarts as $cart)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ $cart->quantity }} Item</td>
                        <td>Rp. {{ number_format($cart->product->price) }}</td>
                        <td>Rp. {{ number_format($cart->product->price * $cart->quantity) }}</td>
                        <td class="text-center"><a href="{{ route('cart.quantity.plus', ['id' => $cart->id]) }}"
                                class="btn btn-primary">Tambah Qty</a></td>
                        <td class="text-center"><a href="{{ route('cart.quantity.minus', ['id' => $cart->id]) }}"
                                class="btn btn-warning">Kurang Qty</a></td>
                        <td class="text-center"><a href="{{ route('cart.delete', ['id' => $cart->id]) }}"
                                class="btn btn-danger">Hapus</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Keranjang Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
