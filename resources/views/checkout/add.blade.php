@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Data Keranjang</div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hovered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allCarts as $cart)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ $cart->quantity }} Item</td>
                        <td>Rp. {{ number_format($cart->product->price) }}</td>
                        <td>Rp. {{ number_format($cart->product->price * $cart->quantity) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th scope="col" colspan="2">Total</th>
                        <td>{{ $totalItem }} Item</td>
                        <td>Rp. {{ number_format($totalSubtotal) }}</td>
                        <td>Rp. {{ number_format($totalPrice) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Pengiriman</div>
        <div class="card-body">
            <form method="POST" action={{ route('checkout.create') }}>
                @csrf
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Provinsi</label>
                            <select class="form-control" id="province" name="city">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($rajaOngkirProvince as $province)
                                <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kota</label>
                            <select class="form-control" id="city" name="city">
                                <option value="">-- Pilih Kota --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kurir</label>
                            <select class="form-control" id="courier" name="courier">
                                <option value="">-- Pilih Kurir --</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS INDONESIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Layanan Kurir</label>
                            <select class="form-control" id="service" name="service">
                                <option value="">-- Pilih Layanan --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <input type="submit" value="Checkout" class="btn btn-primary float-right mt-3">
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#province').change(function () {
            var prov = $('#province').val();

            $.ajax({
                type: 'GET',
                url: '/rajaongkir/city/' + prov,
                success: function (data) {
                    $('#city').empty();
                    $.each(data, function (key, value) {
                        $('#city').append('<option value="' + value.city_id + '">' +
                            value.city_name +
                            '</option>');
                    });
                }
            });
        });

        $('#courier').change(function () {
            var courier = $('#courier').val();
            var city = $('#city').val();

            $.ajax({
                type: 'GET',
                url: '/rajaongkir/service/' + city + '/' + courier,
                success: function (data) {
                    $('#service').empty();
                    $.each(data[0].costs, function (key, value) {
                        $('#service').append('<option value="' + value.cost[0]
                            .value + '">' + value.service +
                            ' - Rp. ' + value.cost[0].value + ' - ' +
                            value.cost[0].etd + ' Hari</option>');
                    });
                }
            });
        });
    });

</script>
