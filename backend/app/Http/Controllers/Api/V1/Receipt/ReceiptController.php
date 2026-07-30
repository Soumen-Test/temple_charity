<?php

namespace App\Http\Controllers\Api\V1\Receipt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Receipt\ReceiptResource;
use App\Models\Receipt;
use Illuminate\Http\JsonResponse;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::query()
            ->with([
                'donation',
                'payment',
            ])
            ->latest()
            ->paginate(20);

        return ReceiptResource::collection(
            $receipts
        );
    }

    public function show(
        Receipt $receipt
    ): ReceiptResource {

        return new ReceiptResource(
            $receipt->load([
                'donation',
                'payment',
            ])
        );
    }

    public function destroy(
        Receipt $receipt
    ): JsonResponse {

        return response()->json([
            'message' =>
                'Receipts are financial documents and cannot be deleted.',
        ], 422);
    }
}