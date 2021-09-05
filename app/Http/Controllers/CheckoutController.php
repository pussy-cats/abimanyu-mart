<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Checkout;
use App\CheckoutDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index()
    {
        $allCheckouts   =   Checkout::where('user_id', '=', Auth::user()->id)
                                    ->whereHas('checkoutDetails.cart')
                                    ->with('checkoutDetails.cart')
                                    ->get();
        $data = [
            'allCheckouts' => $allCheckouts->sortByDesc('created_at'),
        ];
        return view('checkout.index', $data);
    }

    public function addCheckout()
    {
        $allCarts       =   Cart::where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 0)
                                ->with('product')
                                ->get();
        if($allCarts->isEmpty()){
            return redirect()->route('cart.index')->with('flash', [
                'card' => 'warning',
                'message' => 'Data Keranjang anda kosong'
            ]);
        }else{
            $totalItem      =   $allCarts->sum(function($item){
                return $item->quantity;
            });
            $totalSubtotal  =   $allCarts->sum(function($item){
                return $item->product->price;
            });
            $totalPrice     =   $allCarts->sum(function($item){
                return $item->quantity * $item->product->price;
            });

            $data = [
                'allCarts'      =>  $allCarts,
                'totalItem'     =>  $totalItem,
                'totalSubtotal' =>  $totalSubtotal,
                'totalPrice'    =>  $totalPrice,
                'rajaOngkirProvince'    => RajaOngkir::provinsi()->all()
            ];
            return view('checkout.add', $data);
        }
    }

    public function createCheckout(Request $request)
    {
        $allCarts = Cart::where('user_id', '=', Auth::user()->id)
                    ->where('status', '=', 0)
                    ->with('product')
                    ->get();

        $totalPrice = $allCarts->sum(function($item){
            return $item->quantity * $item->product->price;
        });

        $checkout = new Checkout;
        $checkout->total = $totalPrice;
        $checkout->courier = $request->courier;
        $checkout->deliveryfee = $request->service;
        $checkout->address = $request->address;
        $checkout->user_id = Auth::user()->id;
        if($checkout->save()){
            foreach($allCarts as $cart){
                $cart->status = 1;
                $cart->save();
                $checkoutDetail = new CheckoutDetail;
                $checkoutDetail->cart_id = $cart->id;
                $checkoutDetail->checkout_id = $checkout->id;
                $checkoutDetail->save();
            }
            return redirect()->route('checkout.index')->with('flash', [
                'card' => 'success',
                'message' => 'Checkout berhasil'
            ]);
        }else{
            return redirect()->route('checkout.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Checkout gagal'
            ]);
        }
    }

    public function detailCheckout($id){
        $data = [
            'allCheckoutDetails' => Checkout::where('id', '=', $id)->with('checkoutDetails.cart', 'user')->first()
        ];
        return view('checkout.detail', $data);
    }
}
