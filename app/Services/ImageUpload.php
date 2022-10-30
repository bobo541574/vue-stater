<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class ImageUpload
{
    public static function upload(UploadedFile $file, $path, $type)
    {
        $instance = new static();

        return $instance::uploadToStorage($file, $path, $type);
    }

    protected static function uploadToStorage($file, $path, $type)
    {
        $name = $file->getClientOriginalName();

        $file = new File($file);

        $filename = Str::random(40) . "." . $file->guessExtension();

        $disk = Storage::disk(config("services.storage_disk"));

        $response = $disk->putFileAs(
            $path,
            $file,
            $filename,
            ["visibility" => "public", "Cache-Control" => "public, max-age=2628000"]
        );

        return new Image([
            "service"           => config("services.storage_disk"),
            "imageable_type"    => $type,
            "url"               => $response,
            "name"              => $name,
        ]);
    }
}
