<?php

namespace App\Http\Controllers\Api\V1\WebsiteContent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\WebsiteContent\StoreWebsiteContentRequest;
use App\Http\Resources\Api\V1\WebsiteContent\WebsiteContentResource;
use App\Models\WebsiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsiteContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $contents = WebsiteContent::query()
            ->with([
                'organization',
                'temple',
            ])
            ->when(
                $request->filled('organization_id'),
                function ($query) use ($request) {
                    $query->where(
                        'organization_id',
                        $request->organization_id
                    );
                }
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
            ->when(
                $request->filled('content_key'),
                function ($query) use ($request) {
                    $query->where(
                        'content_key',
                        $request->content_key
                    );
                }
            )
            ->when(
                $request->filled('content_type'),
                function ($query) use ($request) {
                    $query->where(
                        'content_type',
                        $request->content_type
                    );
                }
            )
            ->when(
                $request->has('is_active'),
                function ($query) use ($request) {
                    $query->where(
                        'is_active',
                        $request->boolean('is_active')
                    );
                }
            )
            ->orderBy('sort_order')
            ->latest()
            ->paginate(30);

        return WebsiteContentResource::collection(
            $contents
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreWebsiteContentRequest $request
    ): WebsiteContentResource {

        /*
        |--------------------------------------------------------------------------
        | Validate Scope
        |--------------------------------------------------------------------------
        |
        | If temple_id is supplied, make sure that temple belongs
        | to the selected organization.
        |
        */

        if ($request->filled('temple_id')) {

            $validTemple = \App\Models\Temple::query()
                ->where(
                    'id',
                    $request->temple_id
                )
                ->where(
                    'organization_id',
                    $request->organization_id
                )
                ->exists();

            if (!$validTemple) {
                abort(
                    422,
                    'The selected temple does not belong to the selected organization.'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Duplicate Content Key
        |--------------------------------------------------------------------------
        */

        $exists = WebsiteContent::query()
            ->where(
                'content_key',
                $request->content_key
            )
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->where(
                'temple_id',
                $request->temple_id
            )
            ->exists();

        if ($exists) {
            abort(
                422,
                'This content key already exists for the selected scope.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create
        |--------------------------------------------------------------------------
        */

        $content = WebsiteContent::create([

            'uuid' =>
                (string) Str::uuid(),

            'organization_id' =>
                $request->organization_id,

            'temple_id' =>
                $request->temple_id,

            'content_key' =>
                $request->content_key,

            'content_type' =>
                $request->content_type,

            'content_value' =>
                $request->content_value,

            'title' =>
                $request->title,

            'description' =>
                $request->description,

            'is_public' =>
                $request->boolean(
                    'is_public',
                    true
                ),

            'is_active' =>
                $request->boolean(
                    'is_active',
                    true
                ),

            'sort_order' =>
                $request->input(
                    'sort_order',
                    0
                ),

            'created_by' =>
                auth()->id(),
        ]);

        return new WebsiteContentResource(
            $content->load([
                'organization',
                'temple',
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(
        WebsiteContent $websiteContent
    ): WebsiteContentResource {

        return new WebsiteContentResource(
            $websiteContent->load([
                'organization',
                'temple',
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        StoreWebsiteContentRequest $request,
        WebsiteContent $websiteContent
    ): WebsiteContentResource {

        /*
        |--------------------------------------------------------------------------
        | Validate Temple / Organization Relationship
        |--------------------------------------------------------------------------
        */

        if ($request->filled('temple_id')) {

            $validTemple = \App\Models\Temple::query()
                ->where(
                    'id',
                    $request->temple_id
                )
                ->where(
                    'organization_id',
                    $request->organization_id
                )
                ->exists();

            if (!$validTemple) {
                abort(
                    422,
                    'The selected temple does not belong to the selected organization.'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Duplicate Key Check
        |--------------------------------------------------------------------------
        */

        $exists = WebsiteContent::query()
            ->where(
                'content_key',
                $request->content_key
            )
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->where(
                'temple_id',
                $request->temple_id
            )
            ->where(
                'id',
                '!=',
                $websiteContent->id
            )
            ->exists();

        if ($exists) {
            abort(
                422,
                'This content key already exists for the selected scope.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $websiteContent->update([

            'organization_id' =>
                $request->organization_id,

            'temple_id' =>
                $request->temple_id,

            'content_key' =>
                $request->content_key,

            'content_type' =>
                $request->content_type,

            'content_value' =>
                $request->content_value,

            'title' =>
                $request->title,

            'description' =>
                $request->description,

            'is_public' =>
                $request->boolean(
                    'is_public',
                    true
                ),

            'is_active' =>
                $request->boolean(
                    'is_active',
                    true
                ),

            'sort_order' =>
                $request->input(
                    'sort_order',
                    0
                ),

            'updated_by' =>
                auth()->id(),
        ]);

        return new WebsiteContentResource(
            $websiteContent
                ->fresh()
                ->load([
                    'organization',
                    'temple',
                ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        WebsiteContent $websiteContent
    ) {

        $websiteContent->delete();

        return response()->json([
            'message' =>
                'Website content deleted successfully.',
        ]);
    }
}