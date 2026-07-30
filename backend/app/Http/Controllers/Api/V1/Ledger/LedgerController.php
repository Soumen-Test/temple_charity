<?php

namespace App\Http\Controllers\Api\V1\Ledger;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Ledger\LedgerResource;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\OpeningBalance;

class LedgerController extends Controller
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
        | Income
        |--------------------------------------------------------------------------
        |
        | Only successful/completed payments are considered income.
        |
        */
        $openingBalanceQuery = OpeningBalance::query()
            ->where('status', 'active')
            ->where(
                'organization_id',
                $request->organization_id
            )
            ->whereDate(
                'opening_date',
                '<=',
                $fromDate
            );

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

        $payments = Payment::query()
            ->with([
                'donation.project',
                'donation.donor',
            ])
            ->where('status', 'paid')
            ->whereBetween(
                'paid_at',
                [
                    $fromDate . ' 00:00:00',
                    $toDate . ' 23:59:59',
                ]
            )
            ->when(
                $request->organization_id,
                function ($query) use ($request) {
                    $query->whereHas(
                        'donation.project',
                        function ($q) use ($request) {
                            $q->where(
                                'organization_id',
                                $request->organization_id
                            );
                        }
                    );
                }
            )
            ->when(
                $request->project_id,
                function ($query) use ($request) {
                    $query->whereHas(
                        'donation',
                        function ($q) use ($request) {
                            $q->where(
                                'project_id',
                                $request->project_id
                            );
                        }
                    );
                }
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Approved Expenses
        |--------------------------------------------------------------------------
        */

        $expenses = Expense::query()
            ->where('status', 'approved')
            ->whereBetween(
                'expense_date',
                [
                    $fromDate,
                    $toDate,
                ]
            )
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
                $request->project_id,
                function ($query) use ($request) {
                    $query->where(
                        'project_id',
                        $request->project_id
                    );
                }
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Convert Income to Ledger Rows
        |--------------------------------------------------------------------------
        */

        $incomeRows = $payments->map(
            function ($payment) {

                $row = new \stdClass();

                $row->date =
                    $payment->paid_at;

                $row->type =
                    'income';

                $row->reference_no =
                    $payment->payment_no;

                $row->description =
                    'Donation - ' .
                    (
                        $payment->donation
                            ->donation_no
                    );

                $row->income =
                    (float) $payment->amount;

                $row->expense =
                    0;

                $row->currency =
                    $payment->currency;

                return $row;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Convert Expenses to Ledger Rows
        |--------------------------------------------------------------------------
        */

        $expenseRows = $expenses->map(
            function ($expense) {

                $row = new \stdClass();

                $row->date =
                    $expense->expense_date;

                $row->type =
                    'expense';

                $row->reference_no =
                    $expense->expense_no;

                $row->description =
                    $expense->title;

                $row->income =
                    0;

                $row->expense =
                    (float) $expense->amount;

                $row->currency =
                    $expense->currency;

                return $row;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Merge + Sort
        |--------------------------------------------------------------------------
        */

        $rows = $incomeRows
            ->merge($expenseRows)
            ->sortBy('date')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Running Balance
        |--------------------------------------------------------------------------
        */

        $balance = (float) $openingBalance;

        $rows = $rows->map(
            function ($row) use (&$balance) {

                $balance +=
                    $row->income -
                    $row->expense;

                $row->balance =
                    $balance;

                return $row;
            }
        );

        return LedgerResource::collection(
            $rows
        )->additional([
            'meta' => [

                'from_date' =>
                    $fromDate,

                'to_date' =>
                    $toDate,

                'opening_balance' =>
                    $openingBalance,

                'total_income' =>
                    $rows->sum('income'),

                'total_expense' =>
                    $rows->sum('expense'),

                'closing_balance' =>
                    $balance,
            ],
        ]);
    }
}