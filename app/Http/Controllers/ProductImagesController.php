<?php

namespace App\Http\Controllers;

use App\handleFileUpload;
use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    use handleFileUpload;

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

        $columns = ['ID', 'Ürün', 'Görsel', 'Sıra', 'Ürün Kart Görseli Mi?', 'Aktif Mi?'];
        return view('product-images-edit', [
            'productImages' => $productImages,
            'productsArray' => $productsArray,
            'columns' => $columns,
        ]);
    }

    public function update(Request $request)
    {
        // add
        if ($request->has('add')) {
            $request->validate([
                'new_product_id' => ['required', 'integer', 'exists:products,id'],
                'new_image_url' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'new_image_alt' => ['required', 'string', 'max:255'],
                'new_sort_order' => ['required', 'integer', 'min:0'],
            ]);

            $newEntry = ProductImages::create([
                'product_id' => $request->input('new_product_id'),
                'image_url' => null,
                'image_alt' => $request->input('new_image_alt'),
                'sort_order' => $request->input('new_sort_order'),
                'is_main' => 0,
                'status' => 0,
            ]);

            $imageDir = 'images/products';
            $newImageName = $this->handleImageUpload(
                $request,
                'new_image_url',
                $imageDir,
                null
            );
            if ($newImageName) {
                $newEntry->image_url = $newImageName;
            }

            $newEntry->save();
            return redirect()->route('product-images.edit')
                ->with('success', 'Yeni Ürün Görseli Eklendi.');
        }

        // update
        $request->validate([
            'productImages' => ['required', 'array'],
            'productImages.*.id' => ['required', 'integer', 'exists:product_images,id'],
            'productImages.*.image_url' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'productImages.*.image_alt' => ['nullable', 'string', 'max:255'],
            'productImages.*.sort_order' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($request->productImages as $i => $productImageData) {
            $productImage = ProductImages::find($productImageData['id']);
            if ($productImage) {
                $productImage->update([
                    'image_alt' => $productImageData['image_alt'],
                    'sort_order' => $productImageData['sort_order'],
                ]);

                $imageDir = 'images/products';
                $newImageName = $this->handleImageUpload(
                    $request,
                    'productImages.' . $i . '.image_url',
                    $imageDir,
                    $productImage->image_url ?? null
                );
                if ($newImageName) {
                    $productImageData['image_url'] = $newImageName;
                    $productImage->update(['image_url' => $newImageName]);
                }
            }
        }

        return redirect()->route('product-images.edit')
            ->with('success', 'Ürün Görselleri Güncellendi.');
    }

    public function setMainImage($id)
    {
        $productImage = ProductImages::find($id);
        if ($productImage) {
            
            if ($productImage->is_main == 1) {
                return redirect()->route('product-images.edit')
                    ->with('info', 'Seçilen görsel zaten ana görsel olarak ayarlı.');
            }

            // Set all other images of the product to not main
            ProductImages::where('product_id', $productImage->product_id)
                ->update(['is_main' => 0]);

            // Set the selected image as main
            $productImage->is_main = 1;
            $productImage->save();

            return redirect()->route('product-images.edit')
                ->with('success', 'Ana görsel başarıyla değiştirildi.');
        }

        return redirect()->route('product-images.edit')
            ->with('error', 'Görsel bulunamadı.');
    }
}
