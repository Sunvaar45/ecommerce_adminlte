<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function edit()
    {
        $columns = ['ID', 'İsim', 'Veri Tipi', 'Aktif Mi?'];
        $attributes = Attributes::whereIn('status', [0, 1])->get();
        $typeOptionsArray = [
            'text' => 'Metin',
            'boolean' => 'Doğru/Yanlış',
        ];

        return view('attributes-edit', [
            'attributes' => $attributes,
            'columns' => $columns,
            'typeOptionsArray' => $typeOptionsArray,
        ]);
    }

    public function update(Request $request)
    {

    }
}
