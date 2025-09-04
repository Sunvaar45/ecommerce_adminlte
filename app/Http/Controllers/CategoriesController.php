<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CategoriesController extends Controller
{
    public function edit()
    {
        $categories = Categories::whereIn('status', [0, 1])
            ->orderBy('sort_order', 'asc')
            ->get();
        $columns = ['İsim', 'Sıra', 'Aktif'];
        return view('categories-edit', [
            'categories' => $categories,
            'columns' => $columns,
        ]);
    }

    public function update(Request $request)
    {
        // add
        if ($request->has('add')) {
            $request->validate([
                'new_name' => ['required', 'string', 'max:255'],
                'new_sort_order' => ['nullable', 'integer', 'min:0'],
            ]);
            Categories::create([
                'name' => $request->input('new_name'),
                'sort_order' => $request->input('new_sort_order', 0),
                'status' => 0,
            ]);
            return redirect()->route('categories.edit')
                ->with('success', 'Kategori başarıyla eklendi.');
        }

        // update
        $request->validate([
            'categories' => ['required', 'array'],
            'categories.*.id' => ['required', 'integer', 'exists:categories,id'],
            'categories.*.name' => ['required', 'string', 'max:255'],
            'categories.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        foreach ($request->categories as $categoryData) {
            $category = Categories::find($categoryData['id']);
            if ($category) {
                $category->update([
                    'name' => $categoryData['name'],
                    'sort_order' => $categoryData['sort_order'],
                ]);
            }
        }

        return redirect()->route('categories.edit')
            ->with('success', 'Kategoriler başarıyla güncellendi.');
    }
}