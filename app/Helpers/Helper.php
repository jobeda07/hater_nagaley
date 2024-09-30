<?php


use App\Helpers\Classes\FlashMessage;
use App\Helpers\FileUpload\FileUploader;
use Illuminate\Http\UploadedFile;

if (!function_exists('path_join')) {
    function path_join(...$paths): string
    {
        $finalPath = '';
        foreach ($paths as $key => $path) {
            if ($key != 0) {
                $finalPath .= '/';
            }
            $finalPath .= trim($path, '/');
        }
        return $finalPath;
    }
}

if (!function_exists('flash')) {
    function flash(): FlashMessage
    {
        return new FlashMessage();
    }
}

if (!function_exists('fileUploader')) {
    function fileUploader(UploadedFile $file): FileUploader
    {
        return new FileUploader($file);
    }
}

if (!function_exists('storage_url')) {
    function storage_url(string $path): string
    {
        if (\Illuminate\Support\Facades\Storage::getDefaultDriver() == 'public') {
            return asset(\Illuminate\Support\Facades\Storage::url($path));
        }
        return \Illuminate\Support\Facades\Storage::url($path);
    }
}
