<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\ProductAttributeValues;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductAttributeValuesController extends Controller
{
    public function edit(Request $request)
    {
        $columns = ['Ürün ID', 'Özellik ID', 'Değer', 'Sıra', 'Aktif Mi?'];

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

        $query = ProductAttributeValues::whereIn('status', [0, 1])
            ->with('attribute')
            ->orderBy('product_id')
            ->orderBy('sort_order');
            
        $filteredProductId = $request->query('product_id');
        if ($filteredProductId) {
            $query->where('product_id', $filteredProductId);
        }

        $values = $query->get();

        return view('product-attribute-values-edit', [
            'columns' => $columns,
            'values' => $values,
            'filteredProductId' => $filteredProductId,

            'productsArray' => $productsArray,
            'attributesArray' => $attributesArray,
        ]);
    }

    public function update(Request $request)
    {
        // add
        if ($request->has('add')) {
            $request->validate([
                'new_product_id' => ['required', 'exists:products,id'],
                'new_attribute_id' => ['required', 'exists:attributes,id'],
                'new_sort_order' => ['required', 'integer', 'min:0'],
            ]);

            try {
                ProductAttributeValues::create([
                    'product_id' => $request->input('new_product_id'),
                    'attribute_id' => $request->input('new_attribute_id'),
                    'value' => 'Burayı Düzenle',
                    'sort_order' => $request->input('new_sort_order'),
                    'status' => 0,
                ]);
            } catch (\Exception $e) {
                if ($e->getCode() == 23000) { // Integrity constraint violation
                    return redirect()->back()
                        ->with('error', 'Bu ürün için bu özellik zaten mevcut. Lütfen başka bir özellik seçin.');
                }

                return redirect()->back()
                    ->with('error', 'Ürün özellik değeri eklenirken bir hata oluştu: ' . $e->getMessage());
            }

            return redirect()->back()
                ->with('success', 'Yeni ürün özellik değeri eklendi.')
                ->with('info', 'Lütfen değeri düzenleyin.');
        }

        // update
        $request->validate([
            'values' => ['required', 'array'],
            'values.*.product_id' => ['required', 'exists:products,id'],
            'values.*.attribute_id' => ['required', 'exists:attributes,id'],
            'values.*.value' => ['required', 'string'],
            'values.*.sort_order' => ['required', 'integer', 'min:0'],
        ]);

        try {
            foreach ($request->values as $valueData) {
                $value = ProductAttributeValues::find($valueData['id']);
                if ($value) {
                    $value->update([
                        'product_id' => $valueData['product_id'],
                        'attribute_id' => $valueData['attribute_id'],
                        'value' => $valueData['value'],
                        'sort_order' => $valueData['sort_order'],
                    ]);
                }
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                return redirect()->back()
                    ->with('error', 'Bu ürün için bu özellik zaten mevcut. Lütfen başka bir özellik seçin.');
            }

            return redirect()->back()
                ->with('error', 'Ürün özellik değerleri güncellenirken bir hata oluştu: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Ürün özellik değerleri başarıyla güncellendi.');
    }
}
