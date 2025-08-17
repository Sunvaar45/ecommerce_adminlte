<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function edit()
    {
        $products = Products::all();
        $columns = ['ID', 'İsim', 'Açıklama', 'Fiyat', 'İndirim Aktif', 'İndirimli Fiyat', 'Stok', 'Renk', 'Görsel', 'Kategori', 'Aktif'];
        return view('products-edit', [
            'products' => $products,
            'columns' => $columns
        ]);
    }
}
