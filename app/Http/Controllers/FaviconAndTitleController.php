<?php

namespace App\Http\Controllers;

use App\handleFileUpload;
use App\Models\FaviconAndTitle;
use Illuminate\Http\Request;

class FaviconAndTitleController extends Controller
{
    use handleFileUpload;

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
        $request->validate([
            'favicon' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,ico', 'max:2048'],
            'title' => ['nullable', 'string', 'max:255'],
        ]);

        $faviconAndTitle = FaviconAndTitle::first();
        if (!$faviconAndTitle) {
            $faviconAndTitle = new FaviconAndTitle();
        }

        $faviconAndTitleData = $request->only([
            'title',
        ]);

        $newFavicon = $this->handleImageUpload(
            $request,
            'favicon',
            'images/favicon/',
            $faviconAndTitle->favicon ?? null,
        );
        if ($newFavicon) {
            $faviconAndTitleData['favicon'] = $newFavicon;
        }

        $faviconAndTitle->fill($faviconAndTitleData);
        $faviconAndTitle->save();
        
        return redirect()->back()
            ->with('success', ' Sekme logosu ve site adı başarıyla güncellendi.');
    }
}
