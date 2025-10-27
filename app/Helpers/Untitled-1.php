<?php

use Illuminate\Support\Facades\File;

if (!function_exists('image_save')) {

    function image_save(string $folder, string $prefix, $file, ?string $size = null): ?string
    {
        $imagePath = null;

        if ($file) {
            $filename = $prefix;
            if ($size) {
                $sizeClean = str_replace(['*', '/', '\\', ':', '?', '"', '<', '>', '|'], '_', $size);
                $filename .= '_' . $sizeClean;
            }
            $filename .= '_' . time() . '.' . $file->getClientOriginalExtension();

            $destination = public_path('backend/images/' . $folder);
            File::ensureDirectoryExists($destination);
            $file->move($destination, $filename);

            $imagePath = 'backend/images/' . $folder . '/' . $filename;
        }

        return $imagePath;
    }
}

if (!function_exists('image_update')) {

    function image_update(string $folder, string $prefix, $file, ?string $oldPath = null, ?string $size = null): ?string
    {
        if (!$file) {
            return $oldPath;
        }

        if ($oldPath && File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }

        return image_save($folder, $prefix, $file, $size);
    }
}

