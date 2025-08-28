<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CategoriesController extends Controller
{
    public function edit()
    {
        $categories = Categories::whereIn('status', [0, 1])->get();
        $columns = ['ID', 'İsim', 'Aktif'];
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
            ]);
            Categories::create([
                'name' => $request->input('new_name'),
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
        ]);

        foreach ($request->categories as $categoryData) {
            $category = Categories::find($categoryData['id']);
            if ($category) {
                $category->update([
                    'name' => $categoryData['name'],
                ]);
            }
        }

        return redirect()->route('categories.edit')
            ->with('success', 'Kategoriler başarıyla güncellendi.');
    }
}