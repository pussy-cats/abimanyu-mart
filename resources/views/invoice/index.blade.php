<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice - {{ substr(md5($checkoutData->id), 0, 12) }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            background-color: #81c784;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="favicon.png" alt="">
                            </td>

                            <td>
                                Invoice #: {{ substr(md5($checkoutData->id), 0, 12) }}<br>
                                Dibuat: {{ \Carbon\Carbon::parse($checkoutData->created_at)->toDateString() }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b>Abimanyu</b>Mart<br>
                                Jl. Raya Nogosari - Andong KM.1 Ngumbul, Glonggong<br>
                                Nogosari, Boyolali
                            </td>

                            <td>
                                {{ $checkoutData->user->name }}<br>
                                {{ $checkoutData->user->email }}<br>
                                {{ $checkoutData->address }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Nama Produk
                </td>

                <td>
                    Total Harga
                </td>
            </tr>

            @foreach($checkoutData->checkoutDetails as $checkoutDetail)
            <tr class="item">
                <td>
                    {{ $checkoutDetail->cart->product->name }}
                </td>

                <td>
                    Rp. {{ number_format($checkoutDetail->cart->quantity * $checkoutDetail->cart->product->price) }}
                </td>
            </tr>
            @endforeach
            <tr class="item last">
                <td>
                    Ongkos Kirim :
                </td>
                <td>
                    Rp. {{ number_format($checkoutData->deliveryfee) }}
                </td>
            </tr>

            <tr class="total">
                <td></td>

                <td>
                    Total: Rp. {{ number_format($checkoutData->total + $checkoutData->deliveryfee) }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
