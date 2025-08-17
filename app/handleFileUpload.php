<?php

namespace App;

use Illuminate\Support\Facades\Storage;

trait handleFileUpload
{
    protected function handleImageUpload($request, $fieldName, $directory = 'storage/images', $oldFileName)
    {
        if (!$request->hasFile($fieldName)) {
            return $oldFileName; // No new file uploaded, return old file name
        }

        // delete old file if it exists
        if ($oldFileName && Storage::disk('public')->exists($directory . '/' . $oldFileName)) {
            Storage::disk('public')->delete($directory . '/' . $oldFileName);
        }

        // store new file
        $file = $request->file($fieldName);
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs($directory, $fileName, 'public');
        
        return $fileName; // Return the new file name
    }
}
