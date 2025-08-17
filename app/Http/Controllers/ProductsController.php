<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function edit()
    {
        $products = Products::all();
        $categories = Categories::all();
        $columns = ['ID', 'İsim', 'Açıklama', 'Fiyat', 'İndirim Aktif', 'İndirimli Fiyat', 'Stok', 'Renk', 'Görsel', 'Kategori', 'Aktif'];
        return view('products-edit', [
            'products' => $products,
            'categories' => $categories,
            'columns' => $columns,
        ]);
    }

    public function update(Request $request) 
    {
        // delete
        if ($request->has('remove')) {

        }

        // add
        if ($request->has('add')) {

        }

        // update

    }
}
