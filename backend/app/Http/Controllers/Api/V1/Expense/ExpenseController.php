<?php

namespace App\Http\Controllers\Api\V1\Expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Expense\StoreExpenseRequest;
use App\Http\Requests\Api\V1\Expense\UpdateExpenseRequest;
use App\Http\Resources\Api\V1\Expense\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

    public function submit(Expense $expense): ExpenseResource
    {
        if ($expense->status !== 'draft') {
            return response()->json([
                'message' => 'Only draft expenses can be submitted.'
            ], 422);
        }

        $expense->update([
            'status' => 'submitted',
            'submitted_by' => auth()->id(),
            'submitted_at' => now(),
            'updated_by' => auth()->id(),
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

    public function approve(Expense $expense): ExpenseResource
    {
        if ($expense->status !== 'submitted') {
            return response()->json([
                'message' => 'Only submitted expenses can be approved.'
            ], 422);
        }

        $expense->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'updated_by' => auth()->id(),
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

    public function reject(
        Expense $expense,
        Request $request
    ): ExpenseResource {

        if ($expense->status !== 'submitted') {
            return response()->json([
                'message' => 'Only submitted expenses can be rejected.'
            ], 422);
        }

        $request->validate([
            'approval_remarks' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $expense->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'approval_remarks' =>
                $request->approval_remarks,
            'updated_by' => auth()->id(),
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

    public function uploadFile(
        Request $request,
        Expense $expense
    ): FileResource {

        $request->validate([
            'file' => [
                'required',
                'file',
                'max:10240',
            ],

            'collection' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_public' => [
                'nullable',
                'boolean',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $uploadedFile = $request->file('file');

        $fileName = Str::uuid()
            .'.'
            .$uploadedFile->getClientOriginalExtension();

        $path = $uploadedFile->storeAs(
            'expenses/' . $expense->id,
            $fileName,
            'public'
        );

        $file = File::create([
            'fileable_type' =>
                $expense->getMorphClass(),

            'fileable_id' =>
                $expense->id,

            'original_name' =>
                $uploadedFile->getClientOriginalName(),

            'file_name' =>
                $fileName,

            'disk' =>
                'public',

            'path' =>
                $path,

            'mime_type' =>
                $uploadedFile->getMimeType(),

            'extension' =>
                $uploadedFile->getClientOriginalExtension(),

            'size' =>
                $uploadedFile->getSize(),

            'collection' =>
                $request->input(
                    'collection',
                    'expense_attachment'
                ),

            'is_public' =>
                $request->boolean('is_public'),

            'uploaded_by' =>
                auth()->id(),

            'remarks' =>
                $request->input('remarks'),
        ]);

        return new FileResource($file);
    }

    public function files(Expense $expense)
    {
        $files = $expense->files()
            ->latest()
            ->paginate(20);

        return FileResource::collection($files);
    }

    public function detachFile(
        Expense $expense,
        File $file
    ) {
        if (
            $file->fileable_type !==
                $expense->getMorphClass()
            ||
            $file->fileable_id !==
                $expense->id
        ) {
            return response()->json([
                'message' =>
                    'This file does not belong to this expense.'
            ], 422);
        }

        $file->update([
            'fileable_type' => null,
            'fileable_id' => null,
        ]);

        return response()->json([
            'message' =>
                'File detached successfully.'
        ]);
    }
}