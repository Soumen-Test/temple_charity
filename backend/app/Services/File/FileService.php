<?php

namespace App\Services\File;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class FileService
{
    public function upload(
        UploadedFile $uploadedFile,
        ?string $fileableType = null,
        ?int $fileableId = null,
        ?string $collection = null,
        bool $isPublic = false,
        ?int $uploadedBy = null,
        ?string $remarks = null
    ): File {

        $disk = 'public';

        $extension = strtolower(
            $uploadedFile->getClientOriginalExtension()
        );

        $originalName =
            $uploadedFile->getClientOriginalName();

        $fileName =
            Str::uuid() . '.' . $extension;

        /*
        |--------------------------------------------------------------------------
        | Storage Directory
        |--------------------------------------------------------------------------
        */

        $directory = $collection
            ? 'uploads/' . $collection
            : 'uploads/general';

        /*
        |--------------------------------------------------------------------------
        | Store File
        |--------------------------------------------------------------------------
        */

        $path = $uploadedFile->storeAs(
            $directory,
            $fileName,
            $disk
        );

        if (!$path) {
            throw new RuntimeException(
                'File could not be stored.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Image Information
        |--------------------------------------------------------------------------
        */

        $width = null;
        $height = null;

        if (
            in_array(
                strtolower($uploadedFile->getClientOriginalExtension()),
                ['jpg', 'jpeg', 'png', 'webp']
            )
        ) {
            $imageSize = @getimagesize(
                $uploadedFile->getRealPath()
            );

            if ($imageSize) {
                $width = $imageSize[0];
                $height = $imageSize[1];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Create Database Record
        |--------------------------------------------------------------------------
        */

        return File::create([
            'fileable_type' => $fileableType,
            'fileable_id' => $fileableId,

            'original_name' => $originalName,

            'file_name' => $fileName,

            'disk' => $disk,

            'path' => $path,

            'mime_type' =>
                $uploadedFile->getMimeType(),

            'extension' => $extension,

            'size' =>
                $uploadedFile->getSize(),

            'width' => $width,

            'height' => $height,

            'collection' => $collection,

            'is_public' => $isPublic,

            'uploaded_by' => $uploadedBy,

            'remarks' => $remarks,
        ]);
    }

    public function delete(File $file): void
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Physical File
        |--------------------------------------------------------------------------
        */

        if (
            Storage::disk($file->disk)
                ->exists($file->path)
        ) {
            Storage::disk($file->disk)
                ->delete($file->path);
        }

        /*
        |--------------------------------------------------------------------------
        | Soft Delete Database Record
        |--------------------------------------------------------------------------
        */

        $file->delete();
    }
}