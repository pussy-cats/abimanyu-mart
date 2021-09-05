<?php

namespace App\Http\Controllers;

use App\Checkout;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index($id)
    {
        $data = [
            'checkoutData' => Checkout::where('id', '=', $id)->with('checkoutDetails.cart', 'user')->first()
        ];
        $pdf = PDF::loadView('invoice.index', $data);
        return $pdf->stream();
    }
}
