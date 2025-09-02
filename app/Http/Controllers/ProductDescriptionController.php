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

    }
}
