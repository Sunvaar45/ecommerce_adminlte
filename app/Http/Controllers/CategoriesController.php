<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function edit()
    {
        $categories = Categories::where('status', 1)->get();
        return view('categories-edit', [
            'categories' => $categories,
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
                $category->name = $categoryData['name'];
                $category->status = $categoryData['status'];
                $category->save();
            }
        }

        return redirect()->route('categories.edit')
            ->with('success', 'Kategoriler başarıyla güncellendi.');
    }
}
