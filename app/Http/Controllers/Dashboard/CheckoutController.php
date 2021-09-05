<?php

namespace App\Http\Controllers\Dashboard;

use App\Checkout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $allCheckouts = Checkout::with('user', 'checkoutDetails.cart')->withCount('checkoutDetails');
        $data = [
            'allCheckouts' => $allCheckouts->paginate(5),
        ];
        return view('dashboard.checkout.index', $data);
    }

    public function detailCheckout($id)
    {
        $data = [
            'checkoutData' => Checkout::where('id', '=', $id)->with('user', 'checkoutDetails.cart.product')->first()
        ];
        return view('dashboard.checkout.detail', $data);
    }
}
