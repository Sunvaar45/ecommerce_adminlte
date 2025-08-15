<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CategoriesController extends Controller
{
    public function edit()
    {
        $categories = Categories::all();
        $columns = ['ID', 'İsim', 'Aktif'];
        return view('categories-edit', [
            'categories' => $categories,
            'columns' => $columns,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'categories' => ['required', 'array'],
            'categories.*.id' => ['required', 'integer', 'exists:categories,id'],
            'categories.*.name' => ['required', 'string', 'max:255'],
            'categories.*.status' => ['required', 'boolean'],
        ]);

        foreach ($request->categories as $categoryData) {
            $category = Categories::find($categoryData['id']);
            if ($category) {
                $category->update([
                    'name' => $categoryData['name'],
                    'status' => $categoryData['status'],
                ]);
            }
        }

        return redirect()->route('categories.edit')
            ->with('success', 'Kategoriler başarıyla güncellendi.');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.edit')->with('success', 'Kategori ve ilişkili ürünler silindi.');
    }
}
