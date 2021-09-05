@extends('adminlte::page')

@section('title', 'Daftar Produk')

@section('content_header')
<h1 class="m-0 text-dark">Daftar Produk</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.flash')
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Kategori Produk</th>
                            <th scope="col">Harga Produk</th>
                            <th scope="col">Stok Produk</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allProducts as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ "Rp. " . number_format($product->price) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-center"><a
                                    href="{{ route('dashboard.product.edit', ['id' => $product->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                            <td class="text-center"><a
                                    href="{{ route('dashboard.product.delete', ['id' => $product->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-right mt-3">
                    {{ $allProducts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
