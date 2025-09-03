<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\ProductAttributeValues;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductAttributeValuesController extends Controller
{
    public function edit()
    {
        $columns = ['Ürün ID', 'Özellik ID', 'Değer', 'Sıra', 'Aktif Mi?'];
        $values = ProductAttributeValues::whereIn('status', [0, 1])
            ->orderBy('product_id')
            ->orderBy('sort_order')
            ->with('attribute')
            ->get();

        // get product_id dropdown array
        $products = Products::whereIn('status', [0, 1])->get();
        $productsArray = $products->mapWithKeys(function ($product) {
            if ($product->status == 0) {
                return [$product->id => "{$product->id} - {$product->name} - Deaktif"];
            }
            return [$product->id => "{$product->id} - {$product->name}"];
        })->toArray();

        // get attribute_id dropdown array
        $attributes = Attributes::whereIn('status', [0, 1])->get();
        $attributesArray = $attributes->mapWithKeys(function ($attribute) {
            if ($attribute->status == 0) {
                return [$attribute->id => "{$attribute->id} - {$attribute->name} - Deaktif"];
            }
            return [$attribute->id => "{$attribute->id} - {$attribute->name}"];
        })->toArray();

        return view('product-attribute-values-edit', [
            'columns' => $columns,
            'values' => $values,

            'productsArray' => $productsArray,
            'attributesArray' => $attributesArray,
            // 'attributeTypes' => $attributeTypes,
        ]);
    }

    public function update(Request $request)
    {
        // add
        if ($request->has('add')) {
            $request->validate([

            ]);
        }

        // update
    }
}
