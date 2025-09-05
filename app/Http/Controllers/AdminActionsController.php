<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AdminActionsController extends Controller
{
    public function delete($table, $id)
    {
        $this->cascadeDelete($table, $id);

        return redirect()->back()
            ->with('success', 'Kayıt silindi.');
    }

    public function setActiveState($table, $id)
    {
        $item = DB::table($table)
            ->where('id', $id)
            ->first();

        if ($item) {
            $newState = 0;
            if ($item->status == 0) {
                $newState = 1;
            }

            DB::table($table)
                ->where('id', $id)
                ->update(['status' => $newState]);
        }

        return redirect()->back()->with('success', 'Kayıt durumu başarıyla değişti.');
    }

    private function cascadeDelete($table, $id)
    {
        $this->softDelete($table, 'id', $id);

        // category cascade
        if ($table == 'categories') {
            $this->softDelete('products', 'category_id', $id);

            $productIds = DB::table('products')
                ->where('category_id', $id)
                ->pluck('id');

            foreach ($productIds as $productId) {
                $this->cascadeDelete('products', $productId);
            }
        }

        // product cascade
        if ($table == 'products') {
            $this->softDelete('product_images', 'product_id', $id);
            $this->softDelete('product_attribute_values', 'product_id', $id);
        }

        // attribute cascade
        if ($table == 'attributes') {
            $this->softDelete('product_attribute_values', 'attribute_id', $id);
        }
    }

    private function softDelete($table, $column, $value)
    {
        DB::table($table)
            ->where($column, $value)
            ->where('status', '!=', 2)
            ->update(['status' => 2]);
    }
}