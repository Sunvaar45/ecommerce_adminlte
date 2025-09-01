<?php

namespace App;

use Illuminate\Support\Facades\Storage;

trait handleFileUpload
{
    protected function handleImageUpload(
        $request,
        $fieldName,
        $directory,
        $oldFileName = null,
        $disk = null,
    ) {

        // Determine the main project as storage disk to use
        if (!$disk) {
            $disk = env('MAIN_STORAGE_DISK', 'public');
        }

        if (!$request->hasFile($fieldName)) {
            return null; // No new file uploaded, return old file name
        }

        // delete old file if it exists
        if ($oldFileName && Storage::disk($disk)->exists($directory . '/' . $oldFileName)) {
            Storage::disk($disk)->delete($directory . '/' . $oldFileName);
        }

        // grab and name the file
        $file = $request->file($fieldName);
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // save the file in main project storage
        Storage::disk($disk)->putFileAs($directory, $file, $fileName);

        return $fileName; // Return the new file name
    }
}
