<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductDescriptionController extends Controller
{
    public function edit($productId)
    {
        $product = Products::findOrFail($productId);

        return view('products-descriptions-edit', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $product = Products::findOrFail($id);
        $product->description = $request->input('description');
        $product->save();

        return redirect()->route('products.edit')
            ->with('success', 'Ürün açıklaması güncellendi.');
    }
}
