<?php

use Illuminate\Support\Facades\File;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Typography\FontFactory;

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

            $destination = public_path('images/' . $folder);
            File::ensureDirectoryExists($destination);

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($file->getPathname());
            if ($size) {

                $parts = explode('x', $size);
                if (count($parts) === 2) {
                    $height = (int)$parts[0];
                    $width = (int)$parts[1];
                    $image->resizeDown($height, $width);
                }
            }
            $image->save($destination . '/' . $filename);


            $imagePath = 'images/' . $folder . '/' . $filename;
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
