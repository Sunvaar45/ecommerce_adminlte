<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function edit()
    {
        $productImages = ProductImages::whereIn('status', [0, 1])
            ->orderBy('product_id', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get();

        $products = Products::whereIn('status', [0, 1])->get();
        $productsArray = $products->mapWithKeys(function ($product) {
            if ($product->status == 0) {
                return [$product->id => "{$product->id} - {$product->name} - Deaktif"];
            }
            return [$product->id => "{$product->id} - {$product->name}"];
        })->toArray();

        $columns = ['ID', 'Ürün', 'Görsel', 'Sıra', 'Ürün Kartı Görseli', 'Aktif'];
        return view('product-images-edit', [
            'productImages' => $productImages,
            'productsArray' => $productsArray,
            'columns' => $columns,
        ]);
    }

    public function update(Request $request)
    {
        // remove
        if ($request->has('remove')) {


            return redirect()->route('product-images.edit')
                ->with('success', 'Ürün Görseli Silindi.');
        }

        // add
        if ($request->has('add')) {


            return redirect()->route('product-images.edit')
                ->with('success', 'Yeni Ürün Görseli Eklendi.');
        }

        // update
        return redirect()->route('product-images.edit')
            ->with('success', 'Ürün Görselleri Güncellendi.');
    }
}
