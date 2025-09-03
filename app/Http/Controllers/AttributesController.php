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
            'boolean' => 'Evet/Hayır',
        ];

        return view('attributes-edit', [
            'attributes' => $attributes,
            'columns' => $columns,
            'typeOptionsArray' => $typeOptionsArray,
        ]);
    }

    public function update(Request $request)
    {
        // add
        if ($request->has('add')) {
            $request->validate([
                'new_name' => ['required', 'string', 'max:255'],
                'new_type' => ['required', 'in:text,boolean'],
            ]);

            Attributes::create([
                'name' => $request->input('new_name'),
                'type' => $request->input('new_type'),
                'status' => 0,
            ]);

            return redirect()->back()
                ->with('success', 'Yeni özellik başarıyla eklendi.');
        }

        // update
        $validated = $request->validate([
            'attributes' => ['required', 'array'],
            'attributes.*.id' => ['required', 'integer', 'exists:attributes,id'],
            'attributes.*.name' => ['required', 'string', 'max:255'],
            'attributes.*.type' => ['required', 'in:text,boolean'],
        ]);

        foreach ($validated['attributes'] as $attributeData) {
            $attribute = Attributes::find($attributeData['id']);
            if ($attribute) {
                $attribute->update([
                    'name' => $attributeData['name'],
                    'type' => $attributeData['type'],
                ]);
            }
        }

        return redirect()->back()
            ->with('success', 'Özellikler başarıyla güncellendi.');
    }
}
