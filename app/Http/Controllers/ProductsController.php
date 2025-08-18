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
        $request->validate([
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'integer', 'exists:products,id'],
            'products.*.name' => ['required', 'string', 'max:255'],
            'products.*.description' => ['nullable', 'string'],
            'products.*.price' => ['required', 'numeric', 'min:0'],
            'products.*.has_discount' => ['boolean'],
            'products.*.discount_price' => ['nullable', 'numeric', 'min:0'],
            'products.*.stock' => ['required', 'integer', 'min:0'],
            'products.*.color' => ['nullable', 'string', 'max:255'],
            'products.*.image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'products.*.category_id' => ['required', 'integer', 'exists:categories,id'],
            'products.*.status' => ['boolean'],
        ]);

        foreach ($request->products as $productData) {
            
        }
    }
}
