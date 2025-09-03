<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function edit()
    {
        $attributes = Attributes::whereIn('status', [0, 1])->get();

        return view('attributes-edit', [
            'attributes' => $attributes,
        ]);
    }

    public function update(Request $request)
    {

    }
}
