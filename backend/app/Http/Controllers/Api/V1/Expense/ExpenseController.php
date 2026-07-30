<?php

namespace App\Http\Controllers\Api\V1\Expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Expense\StoreExpenseRequest;
use App\Http\Requests\Api\V1\Expense\UpdateExpenseRequest;
use App\Http\Resources\Api\V1\Expense\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $expenses = Expense::query()
            ->with([
                'organization',
                'temple',
                'project',
                'campaign',
                'files',
            ])
            ->latest('expense_date')
            ->paginate(20);

        return ExpenseResource::collection(
            $expenses
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreExpenseRequest $request
    ): ExpenseResource {

        $expense = Expense::create([

            'uuid' =>
                (string) Str::uuid(),

            'expense_no' =>
                $this->generateExpenseNo(),

            'organization_id' =>
                $request->organization_id,

            'temple_id' =>
                $request->temple_id,

            'project_id' =>
                $request->project_id,

            'campaign_id' =>
                $request->campaign_id,

            'expense_date' =>
                $request->expense_date,

            'title' =>
                $request->title,

            'description' =>
                $request->description,

            'expense_category' =>
                $request->expense_category,

            'amount' =>
                $request->amount,

            'currency' =>
                strtoupper(
                    $request->input(
                        'currency',
                        'BDT'
                    )
                ),

            'payment_method' =>
                $request->payment_method,

            'reference_no' =>
                $request->reference_no,

            'status' =>
                'draft',

            'created_by' =>
                auth()->id(),
        ]);

        return new ExpenseResource(
            $expense->load([
                'organization',
                'temple',
                'project',
                'campaign',
                'files',
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(
        Expense $expense
    ): ExpenseResource {

        return new ExpenseResource(
            $expense->load([
                'organization',
                'temple',
                'project',
                'campaign',
                'files',
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        StoreExpenseRequest $request,
        Expense $expense
    ): ExpenseResource {

        if (
            in_array(
                $expense->status,
                ['approved', 'rejected']
            )
        ) {
            return response()->json([
                'message' =>
                    'Approved or rejected expenses cannot be edited.',
            ], 422);
        }

        $expense->update([
            ...$request->validated(),

            'currency' =>
                strtoupper(
                    $request->input(
                        'currency',
                        $expense->currency
                    )
                ),

            'updated_by' =>
                auth()->id(),
        ]);

        return new ExpenseResource(
            $expense->fresh()->load([
                'organization',
                'temple',
                'project',
                'campaign',
                'files',
            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Expense $expense
    ): JsonResponse {

        if ($expense->status === 'approved') {
            return response()->json([
                'message' =>
                    'Approved expenses cannot be deleted.',
            ], 422);
        }

        $expense->delete();

        return response()->json([
            'message' =>
                'Expense deleted successfully.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Expense Number
    |--------------------------------------------------------------------------
    */

    private function generateExpenseNo(): string
    {
        do {
            $number =
                'EXP-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(
                    Str::random(6)
                );

        } while (
            Expense::where(
                'expense_no',
                $number
            )->exists()
        );

        return $number;
    }
}