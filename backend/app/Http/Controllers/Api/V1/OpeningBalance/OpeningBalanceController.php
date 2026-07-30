<?php

namespace App\Http\Controllers\Api\V1\OpeningBalance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\OpeningBalance\StoreOpeningBalanceRequest;
use App\Http\Resources\Api\V1\OpeningBalance\OpeningBalanceResource;
use App\Models\OpeningBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OpeningBalanceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $balances = OpeningBalance::query()
            ->with([
                'organization',
                'temple',
            ])
            ->when(
                $request->organization_id,
                function ($query) use ($request) {
                    $query->where(
                        'organization_id',
                        $request->organization_id
                    );
                }
            )
            ->when(
                $request->temple_id,
                function ($query) use ($request) {
                    $query->where(
                        'temple_id',
                        $request->temple_id
                    );
                }
            )
            ->when(
                $request->financial_year,
                function ($query) use ($request) {
                    $query->where(
                        'financial_year',
                        $request->financial_year
                    );
                }
            )
            ->latest()
            ->paginate(20);

        return OpeningBalanceResource::collection(
            $balances
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreOpeningBalanceRequest $request
    ): OpeningBalanceResource {

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Scope
        |--------------------------------------------------------------------------
        */

        $exists = OpeningBalance::query()
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->where(
                'financial_year',
                $request->financial_year
            )
            ->where(
                'temple_id',
                $request->temple_id
            )
            ->exists();

        if ($exists) {
            abort(
                422,
                'Opening balance already exists for this scope and financial year.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create
        |--------------------------------------------------------------------------
        */

        $balance = OpeningBalance::create([

            'uuid' =>
                (string) Str::uuid(),

            'organization_id' =>
                $request->organization_id,

            'temple_id' =>
                $request->temple_id,

            'financial_year' =>
                $request->financial_year,

            'amount' =>
                $request->amount,

            'currency' =>
                strtoupper(
                    $request->input(
                        'currency',
                        'BDT'
                    )
                ),

            'opening_date' =>
                $request->opening_date,

            'status' =>
                'active',

            'remarks' =>
                $request->remarks,

            'created_by' =>
                auth()->id(),
        ]);

        return new OpeningBalanceResource(
            $balance->load([
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
        OpeningBalance $openingBalance
    ): OpeningBalanceResource {

        return new OpeningBalanceResource(
            $openingBalance->load([
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
        StoreOpeningBalanceRequest $request,
        OpeningBalance $openingBalance
    ): OpeningBalanceResource {

        $openingBalance->update([

            'amount' =>
                $request->amount,

            'currency' =>
                strtoupper(
                    $request->input(
                        'currency',
                        $openingBalance->currency
                    )
                ),

            'opening_date' =>
                $request->opening_date,

            'remarks' =>
                $request->remarks,

            'updated_by' =>
                auth()->id(),
        ]);

        return new OpeningBalanceResource(
            $openingBalance->fresh()->load([
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
        OpeningBalance $openingBalance
    ) {

        $openingBalance->delete();

        return response()->json([
            'message' =>
                'Opening balance deleted successfully.',
        ]);
    }
}