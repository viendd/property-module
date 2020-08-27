<?php

namespace Modules\Product\Traits;
use Illuminate\Support\Facades\Storage;

trait UploadImage
{
    public function uploadImage($file, $folder_path)
    {
        if(isset($file) && is_file($file))
        {
            $nameFile = $this->getFileName($file);
            Storage::disk('public')->putFileAs(
                $folder_path, $file, $nameFile
            );
            return $folder_path .'/'.$nameFile;
        }
    }

    public function getFileName($file)
    {
        $arr = explode('.', $file->getClientOriginalName());
        $extension = end($arr);
        unset($arr[array_key_last($arr)]);
        $name = implode('.', $arr);
        return $name . '_' . time() . '.' . $extension;
    }

    public function deleteImage($folder_path)
    {
        if (Storage::disk('public')->exists($folder_path)){
            Storage::disk('public')->delete($folder_path);
        }
    }
}
