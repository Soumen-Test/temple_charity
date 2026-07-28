<?php

namespace App\Http\Controllers\Api\V1\Temple;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Temple\StoreTempleRequest;
use App\Http\Requests\Api\V1\Temple\UpdateTempleRequest;
use App\Http\Resources\Api\V1\Temple\TempleResource;
use App\Models\Temple;
use Illuminate\Http\JsonResponse;

class TempleController extends Controller
{
    public function index()
    {
        $temples = Temple::query()
            ->with('organization')
            ->latest()
            ->paginate(20);

        return TempleResource::collection(
            $temples
        );
    }

    public function store(
        StoreTempleRequest $request
    ): TempleResource {

        $temple = Temple::create(
            $request->validated()
        );

        return new TempleResource(
            $temple->load('organization')
        );
    }

    public function show(
        Temple $temple
    ): TempleResource {

        return new TempleResource(
            $temple->load('organization')
        );
    }

    public function update(
        UpdateTempleRequest $request,
        Temple $temple
    ): TempleResource {

        $temple->update(
            $request->validated()
        );

        return new TempleResource(
            $temple->fresh()->load('organization')
        );
    }

    public function destroy(
        Temple $temple
    ): JsonResponse {

        if (
            $temple->projects()->exists()
        ) {
            return response()->json([
                'message' =>
                    'This temple cannot be deleted because related projects exist.',
            ], 409);
        }

        $temple->delete();

        return response()->json([
            'message' =>
                'Temple deleted successfully.',
        ]);
    }
}