<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'allProducts' => Product::paginate(5)
        ];
        return view('dashboard.product.index', $data);
    }

    public function addProduct()
    {
        return view('dashboard.product.add');
    }

    public function createProduct(Request $request)
    {
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $destinationPath = 'images/product';
        if($file->move($destinationPath, $fileName)){
            $product = new Product;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category = $request->category;
            $product->description = $request->description;
            $product->file = $fileName;
            if($product->save()){
                return redirect()->route('dashboard.product.index')->with('flash', [
                    'card' => 'success',
                    'message' => 'Data Produk berhasil ditambahkan'
                ]);
            }else{
                return redirect()->route('dashboard.product.index')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Data Produk gagal ditambahkan'
                ]);
            }
        }else{
            return redirect()->route('dashboard.product.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Foto Produk gagal terunggah'
            ]);
        }
    }

    public function editProduct($id)
    {
        $data = [
            'productData' => Product::find($id)
        ];
        return view('dashboard.product.edit', $data);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if(empty($product)){
            return redirect()->route('dashboard.product.index')->with('flash', [
                'card' => 'warning',
                'message' => 'Data Produk tidak ditemukan'
            ]);
        }else{
            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category = $request->category;
            $product->description = $request->description;
            if($product->save()){
                return redirect()->route('dashboard.product.index')->with('flash', [
                    'card' => 'success',
                    'message' => 'Data Produk berhasil diubah'
                ]);
            }else{
                return redirect()->route('dashboard.product.index')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Data Produk gagal diubah'
                ]);
            }
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if($product->delete()){
            return redirect()->route('dashboard.product.index')->with('flash', [
                'card' => 'success',
                'message' => 'Hapus Data Produk berhasil'
            ]);
        }else{
            return redirect()->route('dashboard.product.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Hapus Data Produk gagal'
            ]);
        }
    }
}
