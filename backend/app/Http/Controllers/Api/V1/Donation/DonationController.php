<?php

namespace App\Http\Controllers\Api\V1\Donation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Donation\StoreDonationRequest;
use App\Http\Requests\Api\V1\Donation\UpdateDonationRequest;
use App\Http\Resources\Api\V1\Donation\DonationResource;
use App\Models\Donation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::query()
            ->with([
                'donor',
                'project',
                'campaign',
            ])
            ->latest()
            ->paginate(20);

        return DonationResource::collection(
            $donations
        );
    }

    public function store(
        StoreDonationRequest $request
    ): DonationResource {

        $donation = DB::transaction(
            function () use ($request) {

                return Donation::create([
                    'uuid' => (string) Str::uuid(),

                    'donation_no' =>
                        $this->generateDonationNo(),

                    'donor_id' =>
                        $request->input('donor_id'),

                    'project_id' =>
                        $request->input('project_id'),

                    'campaign_id' =>
                        $request->input('campaign_id'),

                    'amount' =>
                        $request->input('amount'),

                    'currency' =>
                        strtoupper(
                            $request->input(
                                'currency',
                                'BDT'
                            )
                        ),

                    'donation_type' =>
                        $request->input(
                            'donation_type',
                            'one_time'
                        ),

                    'is_anonymous' =>
                        $request->boolean(
                            'is_anonymous'
                        ),

                    'status' => 'pending',

                    'donor_note' =>
                        $request->input(
                            'donor_note'
                        ),

                    'created_by' =>
                        auth()->id(),
                ]);
            }
        );

        return new DonationResource(
            $donation->load([
                'donor',
                'project',
                'campaign',
            ])
        );
    }

    public function show(
        Donation $donation
    ): DonationResource {

        return new DonationResource(
            $donation->load([
                'donor',
                'project',
                'campaign',
            ])
        );
    }

    public function update(
        UpdateDonationRequest $request,
        Donation $donation
    ): DonationResource {

        /*
        |--------------------------------------------------------------------------
        | Completed Donation Protection
        |--------------------------------------------------------------------------
        */

        if ($donation->status === 'completed') {
            return response()->json([
                'message' =>
                    'Completed donations cannot be modified.',
            ], 422);
        }

        $donation->update(
            $request->validated()
        );

        return new DonationResource(
            $donation->fresh()->load([
                'donor',
                'project',
                'campaign',
            ])
        );
    }

    public function destroy(
        Donation $donation
    ): JsonResponse {

        /*
        |--------------------------------------------------------------------------
        | Financial Record Protection
        |--------------------------------------------------------------------------
        */

        if ($donation->status === 'completed') {
            return response()->json([
                'message' =>
                    'Completed donations cannot be deleted.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Payment Protection
        |--------------------------------------------------------------------------
        */

        if ($donation->payments()->exists()) {
            return response()->json([
                'message' =>
                    'This donation cannot be deleted because payment records exist.',
            ], 422);
        }

        $donation->delete();

        return response()->json([
            'message' =>
                'Donation deleted successfully.',
        ]);
    }

    private function generateDonationNo(): string
    {
        do {
            $number =
                'DON-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(
                    Str::random(6)
                );

        } while (
            Donation::where(
                'donation_no',
                $number
            )->exists()
        );

        return $number;
    }
}