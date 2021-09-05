@extends('layouts.app')

@section('title', 'Riwayat Belanja')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Riwayat Belanja</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Pemesanan</th>
                        <th scope="col">Total</th>
                        <th scope="col">Kurir</th>
                        <th scope="col">Ongkos Kirim</th>
                        <th scope="col">Hari Transaksi</th>
                        <th scope="col" class="text-center" colspan="3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allCheckouts as $checkout)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>PM-{{ substr(md5($checkout->id), 0, 10) }}</td>
                        <td>Rp. {{ number_format($checkout->total) }}</td>
                        <td>{{ strtoupper($checkout->courier) }}</td>
                        <td>Rp. {{ number_format($checkout->deliveryfee) }}</td>
                        <td>{{ \Carbon\Carbon::parse($checkout->created_at)->toFormattedDateString() }}</td>
                        <td class="text-center"><a href="{{ route('checkout.detail', ['id' => $checkout->id]) }}"
                                class="btn btn-info">Detail</a></td>
                        <td class="text-center"><a href="{{ route('invoiceIndex', ['id' => $checkout->id]) }}"
                                class="btn btn-primary">Cetak Nota</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Tidak ada riwayat belanja</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
