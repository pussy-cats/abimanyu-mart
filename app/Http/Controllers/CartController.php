<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $data = [
            'allCarts'      => Cart::where('user_id', '=', Auth::user()->id)
                            ->with('product')
                            ->where('status', '=', 0)
                            ->get(),
        ];
        return view('cart.index', $data);
    }

    public function addCart($id)
    {
        $cart = Cart::where('user_id', '=', Auth::user()->id)
                    ->where('product_id', '=', $id)
                    ->where('status', '=', 0)
                    ->first();
        if(empty($cart)){
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $id;
            $cart->quantity = 1;
            if($cart->save()){
                return redirect()->route('home')->with('flash', [
                    'card' => 'success',
                    'message' => 'Data Produk berhasil ditambahkan ke Keranjang'
                ]);
            }else{
                return redirect()->route('home')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Data Produk gagal ditambahkan ke Keranjang'
                ]);
            }
        }else{
            $cart = Cart::where('user_id', '=', Auth::user()->id)
                        ->where('product_id', '=', $id)
                        ->first();
            $cart->quantity = $cart->quantity + 1;
            if($cart->save()){
                return redirect()->route('home')->with('flash', [
                    'card' => 'success',
                    'message' => 'Data Produk berhasil ditambahkan ke Keranjang'
                ]);
            }else{
                return redirect()->route('home')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Data Produk gagal ditambahkan ke Keranjang'
                ]);
            }
        }
    }

    public function plusQuantity($id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity + 1;
        if($cart->save()){
            return redirect()->route('cart.index')->with('flash', [
                'card' => 'success',
                'message' => 'Jumlah Belanja berhasil diubah'
            ]);
        }else{
            return redirect()->route('cart.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Jumlah Belanja gagal diubah'
            ]);
        }
    }

    public function minusQuantity($id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity - 1;
        if($cart->save()){
            return redirect()->route('cart.index')->with('flash', [
                'card' => 'success',
                'message' => 'Jumlah Belanja berhasil diubah'
            ]);
        }else{
            return redirect()->route('cart.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Jumlah Belanja gagal diubah'
            ]);
        }
    }

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        if($cart->delete()){
            return redirect()->route('cart.index')->with('flash', [
                'card' => 'success',
                'message' => 'Keranjang Belanja berhasil dihapus'
            ]);
        }else{
            return redirect()->route('cart.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Keranjang Belanja gagal dihapus'
            ]);
        }
    }
}
