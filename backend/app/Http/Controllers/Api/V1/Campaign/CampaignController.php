<?php

namespace App\Http\Controllers\Api\V1\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Campaign\StoreCampaignRequest;
use App\Http\Requests\Api\V1\Campaign\UpdateCampaignRequest;
use App\Http\Resources\Api\V1\Campaign\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::query()
            ->with('project')
            ->latest()
            ->paginate(20);

        return CampaignResource::collection(
            $campaigns
        );
    }

    public function store(
        StoreCampaignRequest $request
    ): CampaignResource {

        $campaign = Campaign::create(
            array_merge(
                $request->validated(),
                [
                    'created_by' =>
                        auth()->id(),
                ]
            )
        );

        return new CampaignResource(
            $campaign->load('project')
        );
    }

    public function show(
        Campaign $campaign
    ): CampaignResource {

        return new CampaignResource(
            $campaign->load('project')
        );
    }

    public function update(
        UpdateCampaignRequest $request,
        Campaign $campaign
    ): CampaignResource {

        $campaign->update(
            array_merge(
                $request->validated(),
                [
                    'updated_by' =>
                        auth()->id(),
                ]
            )
        );

        return new CampaignResource(
            $campaign->fresh()->load('project')
        );
    }

    public function destroy(
        Campaign $campaign
    ): JsonResponse {

        $campaign->delete();

        return response()->json([
            'message' =>
                'Campaign deleted successfully.',
        ]);
    }
}