<?php

namespace App\Http\Controllers;

use App\Models\FaviconAndTitle;
use Illuminate\Http\Request;

class FaviconAndTitleController extends Controller
{
    public function edit()
    {
        $columns = ['Site İkonu', 'Sİte İsmi'];
        $faviconAndTitle = FaviconAndTitle::first();

        return view('favicon-and-title-edit', [
            'columns' => $columns,
            'faviconAndTitle' => $faviconAndTitle,
        ]);
    }

    public function update(Request $request)
    {

        return redirect()->back()
            ->with('success', ' Favicon ve başlık başarıyla güncellendi.');
    }
}
