@extends('adminlte::page')

@section('title', 'Daftar Penjualan')

@section('content_header')
<h1 class="m-0 text-dark">Daftar Penjualan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.flash')
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Jumlah Item</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Biaya Ongkir</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allCheckouts as $checkout)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $checkout->user->name }}</td>
                            <td>{{ $checkout->checkoutDetails->sum('cart.quantity') }} Item</td>
                            <td>Rp. {{ number_format($checkout->total) }}</td>
                            <td>Rp. {{ number_format($checkout->deliveryfee) }}</td>
                            <td>{{ \Carbon\Carbon::parse($checkout->created_at)->toFormattedDateString() }}</td>
                            <td class="text-center"><a
                                    href="{{ route('dashboard.checkout.detail', ['id' => $checkout->id]) }}"
                                    class="btn btn-info">Detail</a></td>
                            <td class="text-center"><a href="{{ route('invoiceIndex', ['id' => $checkout->id]) }}"
                                    class="btn btn-success">Cetak Nota</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
