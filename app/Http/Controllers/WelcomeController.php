<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $data = [
            'newProducts' => Product::get()
                                ->sortByDesc('created_at')
                                ->take(4)
        ];
        return view('welcome', $data);
    }
}
