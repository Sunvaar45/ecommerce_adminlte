<?php

namespace App\Http\Controllers;

use App\Models\FaviconAndTitle;
use Illuminate\Http\Request;

class FaviconAndTitleController extends Controller
{
    public function edit()
    {
        $faviconAndTitle = FaviconAndTitle::first();

        return view('favicon-and-title-edit', [
            'faviconAndTitle' => $faviconAndTitle,
        ]);
    }

    public function update(Request $request)
    {

        return redirect()->back()
            ->with('success', ' Favicon ve başlık başarıyla güncellendi.');
    }
}
