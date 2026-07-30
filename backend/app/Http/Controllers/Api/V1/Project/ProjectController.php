<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Project\StoreProjectRequest;
use App\Http\Requests\Api\V1\Project\UpdateProjectRequest;
use App\Http\Resources\Api\V1\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\V1\File\StoreFileRequest;
use App\Http\Resources\Api\V1\File\FileResource;
use App\Services\File\FileService;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->with([
                'organization',
                'temple',
            ])
            ->latest()
            ->paginate(20);

        return ProjectResource::collection(
            $projects
        );
    }

    public function store(
        StoreProjectRequest $request
    ): ProjectResource {

        $project = Project::create(
            $request->validated()
        );

        return new ProjectResource(
            $project->load([
                'organization',
                'temple',
            ])
        );
    }

    public function show(
        Project $project
    ): ProjectResource {

        return new ProjectResource(
            $project->load([
                'organization',
                'temple',
            ])
        );
    }

    public function update(
        UpdateProjectRequest $request,
        Project $project
    ): ProjectResource {

        $project->update(
            $request->validated()
        );

        return new ProjectResource(
            $project->fresh()->load([
                'organization',
                'temple',
            ])
        );
    }

    public function destroy(
        Project $project
    ): JsonResponse {

        /*
         * Later we will check:
         * Donations
         * Expenses
         * Campaigns
         * Gallery
         *
         * before deletion.
         */

        $project->delete();

        return response()->json([
            'message' =>
                'Project deleted successfully.',
        ]);
    }

    public function uploadFile(
        StoreFileRequest $request,
        Project $project,
        FileService $fileService
    ): FileResource {

        $file = $fileService->upload(
            uploadedFile: $request->file('file'),

            fileableType:
                $project->getMorphClass(),

            fileableId:
                $project->id,

            collection:
                $request->input(
                    'collection',
                    'project'
                ),

            isPublic:
                $request->boolean('is_public'),

            uploadedBy:
                auth()->id(),

            remarks:
                $request->input('remarks')
        );

        return new FileResource($file);
    }
}