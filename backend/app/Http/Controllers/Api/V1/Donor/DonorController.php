<?php

namespace App\Http\Controllers\Api\V1\Donor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Donor\StoreDonorRequest;
use App\Http\Requests\Api\V1\Donor\UpdateDonorRequest;
use App\Http\Resources\Api\V1\Donor\DonorResource;
use App\Models\Donor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::query()
            ->withCount([
                'donations as donation_count' => function ($query) {
                    $query->where('status', 'completed');
                },
            ])
            ->withSum([
                'donations as total_donation' => function ($query) {
                    $query->where('status', 'completed');
                },
            ], 'amount')
            ->latest()
            ->paginate(20);

        return DonorResource::collection($donors);
    }

    public function store(
        StoreDonorRequest $request
    ): DonorResource {

        $donor = Donor::create([
            ...$request->validated(),

            'uuid' => (string) Str::uuid(),
        ]);

        return new DonorResource(
            $donor->loadCount('donations')
        );
    }

    public function show(
        Donor $donor
    ): DonorResource {

        $donor->loadCount([
            'donations as donation_count' => function ($query) {
                $query->where('status', 'completed');
            },
        ]);

        $donor->loadSum([
            'donations as total_donation' => function ($query) {
                $query->where('status', 'completed');
            },
        ], 'amount');

        return new DonorResource($donor);
    }

    public function update(
        UpdateDonorRequest $request,
        Donor $donor
    ): DonorResource {

        $donor->update(
            $request->validated()
        );

        return new DonorResource(
            $donor->fresh()
        );
    }

    public function destroy(
        Donor $donor
    ): JsonResponse {

        /*
        |--------------------------------------------------------------------------
        | Donation Protection
        |--------------------------------------------------------------------------
        |
        | Donor-এর donation history থাকলে donor delete
        | না করে inactive/soft delete করা safer.
        |
        */

        if ($donor->donations()->exists()) {
            return response()->json([
                'message' =>
                    'This donor cannot be deleted because donation history exists. You may deactivate the donor instead.',
            ], 422);
        }

        $donor->delete();

        return response()->json([
            'message' =>
                'Donor deleted successfully.',
        ]);
    }
}