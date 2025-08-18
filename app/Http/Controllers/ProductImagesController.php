<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function edit()
    {
        $productImages = ProductImages::all();
        $columns = ['ID', 'Ürün', 'Görsel', 'Alternatif Metin', 'Aktif'];
        return view('product-images-edit', [
            'productImages' => $productImages,
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
