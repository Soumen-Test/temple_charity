<?php

namespace App\Http\Controllers\Api\V1\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Organization\StoreOrganizationRequest;
use App\Http\Requests\Api\V1\Organization\UpdateOrganizationRequest;
use App\Http\Resources\Api\V1\Organization\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::query()
            ->latest()
            ->paginate(20);

        return OrganizationResource::collection(
            $organizations
        );
    }

    public function store(
        StoreOrganizationRequest $request
    ): OrganizationResource {

        $organization = Organization::create(
            $request->validated()
        );

        return new OrganizationResource(
            $organization
        );
    }

    public function show(
        Organization $organization
    ): OrganizationResource {

        return new OrganizationResource(
            $organization
        );
    }

    public function update(
        UpdateOrganizationRequest $request,
        Organization $organization
    ): OrganizationResource {

        $organization->update(
            $request->validated()
        );

        return new OrganizationResource(
            $organization->fresh()
        );
    }

    public function destroy(
        Organization $organization
    ): JsonResponse {

        $dependencies = [];

        if ($organization->temples()->exists()) {
            $dependencies[] = 'temples';
        }

        if ($organization->projects()->exists()) {
            $dependencies[] = 'projects';
        }

        if (!empty($dependencies)) {
            return response()->json([
                'message' =>
                    'This organization cannot be deleted because related records exist.',

                'dependencies' => $dependencies,
            ], 409);
        }

        $organization->delete();

        return response()->json([
            'message' =>
                'Organization deleted successfully.',
        ]);
    }
}