<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\WebsiteContent;
use Illuminate\Http\Request;

class WebsiteContentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'organization_id' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'temple_id' => [
                'nullable',
                'integer',
                'exists:temples,id',
            ],
        ]);

        $contents = WebsiteContent::query()
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->where(
                'is_public',
                true
            )
            ->where(
                'is_active',
                true
            )
            ->when(
                $request->filled('temple_id'),
                function ($query) use ($request) {
                    $query->where(
                        'temple_id',
                        $request->temple_id
                    );
                }
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get([
                'uuid',
                'organization_id',
                'temple_id',
                'content_key',
                'content_type',
                'content_value',
                'title',
                'description',
                'sort_order',
            ]);

        return response()->json([
            'data' => $contents,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Get Single Content By Key
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        string $contentKey
    ) {
        $request->validate([
            'organization_id' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'temple_id' => [
                'nullable',
                'integer',
                'exists:temples,id',
            ],
        ]);

        $content = WebsiteContent::query()
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->where(
                'content_key',
                $contentKey
            )
            ->where(
                'is_public',
                true
            )
            ->where(
                'is_active',
                true
            )
            ->when(
                $request->filled('temple_id'),
                function ($query) use ($request) {
                    $query->where(
                        'temple_id',
                        $request->temple_id
                    );
                }
            )
            ->first();

        if (!$content) {
            return response()->json([
                'message' =>
                    'Website content not found.',
            ], 404);
        }

        return response()->json([
            'data' => $content,
        ]);
    }
}