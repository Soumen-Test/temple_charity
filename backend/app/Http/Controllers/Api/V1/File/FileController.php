<?php

namespace App\Http\Controllers\Api\V1\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\File\StoreFileRequest;
use App\Http\Resources\Api\V1\File\FileResource;
use App\Models\File;
use App\Services\File\FileService;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    public function store(
        StoreFileRequest $request,
        FileService $fileService
    ): FileResource {

        $file = $fileService->upload(
            uploadedFile: $request->file('file'),

            fileableType:
                $request->input('fileable_type'),

            fileableId:
                $request->input('fileable_id'),

            collection:
                $request->input('collection'),

            isPublic:
                $request->boolean('is_public'),

            uploadedBy:
                auth()->id(),

            remarks:
                $request->input('remarks')
        );

        return new FileResource($file);
    }

    public function show(
        File $file
    ): FileResource {

        return new FileResource($file);
    }

    public function destroy(
        File $file,
        FileService $fileService
    ): JsonResponse {

        $fileService->delete($file);

        return response()->json([
            'message' =>
                'File deleted successfully.',
        ]);
    }
}