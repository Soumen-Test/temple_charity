<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Public\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Campaign List
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

            'project_id' => [
                'nullable',
                'integer',
                'exists:projects,id',
            ],
        ]);

        $campaigns = Campaign::query()
            ->where('is_public', true)
            ->where('status', 'active')

            ->whereHas(
                'project',
                function ($query) use ($request) {

                    $query->where(
                        'organization_id',
                        $request->organization_id
                    );

                    if ($request->filled('project_id')) {
                        $query->where(
                            'id',
                            $request->project_id
                        );
                    }

                    $query->where(
                        'is_public',
                        true
                    );

                    $query->where(
                        'status',
                        'active'
                    );
                }
            )

            ->with('project')

            ->withSum([
                'donations as collected_amount' => function ($query) {
                    $query->where(
                        'status',
                        'completed'
                    );
                }
            ], 'amount')

            ->orderByDesc('is_featured')
            ->orderBy('start_date')

            ->get();

        return CampaignResource::collection(
            $campaigns
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Public Campaign Details
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

        $campaign = Campaign::query()
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

            ->whereHas(
                'project',
                function ($query) use ($request) {

                    $query->where(
                        'organization_id',
                        $request->organization_id
                    );

                    $query->where(
                        'is_public',
                        true
                    );

                    $query->where(
                        'status',
                        'active'
                    );
                }
            )

            ->with('project')

            ->withSum([
                'donations as collected_amount' => function ($query) {
                    $query->where(
                        'status',
                        'completed'
                    );
                }
            ], 'amount')

            ->first();

        if (!$campaign) {

            return response()->json([
                'message' =>
                    'Campaign not found.',
            ], 404);
        }

        return new CampaignResource(
            $campaign
        );
    }
}