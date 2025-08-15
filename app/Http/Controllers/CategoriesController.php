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
        
    }
}
