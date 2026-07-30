<?php

namespace App\Http\Controllers\Api\V1\FinancialSummary;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\OpeningBalance;
use Illuminate\Http\Request;

class FinancialSummaryController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'from_date' => [
                'nullable',
                'date',
            ],

            'to_date' => [
                'nullable',
                'date',
                'after_or_equal:from_date',
            ],

            'organization_id' => [
                'nullable',
                'integer',
                'exists:organizations,id',
            ],

            'temple_id' => [
                'nullable',
                'integer',
                'exists:temples,id',
            ],

            'project_id' => [
                'nullable',
                'integer',
                'exists:projects,id',
            ],
        ]);

        $fromDate = $request->input(
            'from_date',
            now()->startOfMonth()->toDateString()
        );

        $toDate = $request->input(
            'to_date',
            now()->toDateString()
        );

        /*
        |--------------------------------------------------------------------------
        | Opening Balance
        |--------------------------------------------------------------------------
        */

        $openingBalanceQuery = OpeningBalance::query()
            ->where('status', 'active')
            ->whereDate(
                'opening_date',
                '<=',
                $fromDate
            );

        if ($request->filled('organization_id')) {

            $openingBalanceQuery->where(
                'organization_id',
                $request->organization_id
            );
        }

        if ($request->filled('temple_id')) {

            $openingBalanceQuery->where(
                'temple_id',
                $request->temple_id
            );

        } else {

            $openingBalanceQuery->whereNull(
                'temple_id'
            );
        }

        $openingBalance =
            (float) $openingBalanceQuery->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Income
        |--------------------------------------------------------------------------
        */

        $incomeQuery = Donation::query()
            ->where('status', 'completed')
            ->whereBetween(
                'donated_at',
                [
                    $fromDate . ' 00:00:00',
                    $toDate . ' 23:59:59',
                ]
            );

        if ($request->filled('organization_id')) {

            $incomeQuery->whereHas(
                'project',
                function ($query) use ($request) {

                    $query->where(
                        'organization_id',
                        $request->organization_id
                    );
                }
            );
        }

        if ($request->filled('project_id')) {

            $incomeQuery->where(
                'project_id',
                $request->project_id
            );
        }

        $totalDonation =
            (float) $incomeQuery->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Expense
        |--------------------------------------------------------------------------
        */

        $expenseQuery = Expense::query()
            ->where('status', 'approved')
            ->whereBetween(
                'expense_date',
                [
                    $fromDate,
                    $toDate,
                ]
            );

        if ($request->filled('organization_id')) {

            $expenseQuery->where(
                'organization_id',
                $request->organization_id
            );
        }

        if ($request->filled('temple_id')) {

            $expenseQuery->where(
                'temple_id',
                $request->temple_id
            );
        }

        if ($request->filled('project_id')) {

            $expenseQuery->where(
                'project_id',
                $request->project_id
            );
        }

        $totalExpense =
            (float) $expenseQuery->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Balance
        |--------------------------------------------------------------------------
        */

        $closingBalance =
            $openingBalance
            + $totalDonation
            - $totalExpense;

        return response()->json([
            'data' => [

                'opening_balance' =>
                    $openingBalance,

                'total_income' =>
                    $totalDonation,

                'total_expense' =>
                    $totalExpense,

                'closing_balance' =>
                    $closingBalance,

                'currency' =>
                    'BDT',
            ],

            'filters' => [

                'from_date' =>
                    $fromDate,

                'to_date' =>
                    $toDate,

                'organization_id' =>
                    $request->organization_id,

                'temple_id' =>
                    $request->temple_id,

                'project_id' =>
                    $request->project_id,
            ],
        ]);
    }
}