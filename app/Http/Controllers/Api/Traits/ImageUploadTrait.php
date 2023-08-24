<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    public function uploadImage($image)
    {
        $filename = time() . '_'. $image->getClientOriginalName();
        $file_path = $image->storeAs('public/images', $filename);

        $result['name'] = $filename;
        $result['path'] = $file_path;
        return $result;

    }
    public function deleteImage($image)
    {
        try {
            if ($image) {
                Storage::delete($image);
            }

            return true;
        } catch (\Throwable $th) {
            report($th);

            return $th->getMessage();
        }
    }

}
