<?php

namespace App\Http\Controllers;

use App\handleFileUpload;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use handleFileUpload;

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
            'products.*.image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'products.*.category_id' => ['required', 'integer', 'exists:categories,id'],
            'products.*.status' => ['boolean'],
        ]);

        foreach ($request->products as $i => $productData) {
            $product = Products::find($productData['id']);
            if ($product) {
                // update attributes
                $product->update([
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'has_discount' => $productData['has_discount'],
                    'discount_price' => $productData['discount_price'],
                    'stock' => $productData['stock'],
                    'color' => $productData['color'],
                    'category_id' => $productData['category_id'],
                    'status' => $productData['status'],
                ]);

                // update image
                $imageDir = 'images/products/' . $product->id;
                $newImageName = $this->handleImageUpload($request, "products.$i.image_url", $imageDir, $product->image_url ?? null);
                if ($newImageName) {
                    $productData['image_url'] = $newImageName;
                    $product->update(['image_url' => $newImageName]);
                }
            }
        }
        
        return redirect()->route('products.edit')
            ->with('success', 'Ürünler başarıyla güncellendi.');
    }
}
