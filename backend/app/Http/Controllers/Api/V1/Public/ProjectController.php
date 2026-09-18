<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Public\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Project List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $request->validate([
            'organization_id' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],
        ]);

        $projects = Project::query()
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->where(
                'is_public',
                true
            )
            ->where(
                'status',
                'active'
            )
            ->with([
                'campaigns' => function ($query) {
                    $query
                        ->where('is_public', true)
                        ->where('status', 'active')
                        ->orderBy('start_date');
                },
            ])
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->get();

        return ProjectResource::collection(
            $projects
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Public Project Details
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        string $slug
    ) {
        $request->validate([
            'organization_id' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],
        ]);

        $project = Project::query()
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->where(
                'slug',
                $slug
            )
            ->where(
                'is_public',
                true
            )
            ->where(
                'status',
                'active'
            )
            ->with([
                'campaigns' => function ($query) {
                    $query
                        ->where('is_public', true)
                        ->where('status', 'active')
                        ->orderBy('start_date');
                },
            ])
            ->first();

        if (!$project) {
            return response()->json([
                'message' =>
                    'Project not found.',
            ], 404);
        }

        return new ProjectResource(
            $project
        );
    }
}