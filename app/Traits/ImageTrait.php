<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function uploadImage($image, $path, $oldImage = null, $disk = 'public')
    {
        if (empty($image)) {
            return $oldImage;
        }

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        Storage::disk($disk)->put($path . '/' . $imageName, file_get_contents($image->getRealPath()));

        if (!empty($oldImage)) {
            $this->deleteImage($oldImage, $path, $disk);
        }

        return $imageName;
    }

    public function deleteImage($imageName, $path, $disk = 'public'): void
    {
        $filePath = $path . '/' . $imageName;

        if (Storage::disk($disk)->exists($filePath)) {
            Storage::disk($disk)->delete($filePath);
        }
    }
}
