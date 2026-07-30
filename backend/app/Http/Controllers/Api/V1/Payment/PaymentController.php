<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Payment\StorePaymentRequest;
use App\Http\Requests\Api\V1\Payment\UpdatePaymentRequest;
use App\Http\Resources\Api\V1\Payment\PaymentResource;
use App\Models\Donation;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\Payment\PaymentConfirmationService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::query()
            ->with([
                'donation',
            ])
            ->latest()
            ->paginate(20);

        return PaymentResource::collection(
            $payments
        );
    }

    public function store(
        StorePaymentRequest $request
    ): PaymentResource {

        $payment = DB::transaction(
            function () use ($request) {

                $donation = Donation::lockForUpdate()
                    ->findOrFail(
                        $request->input('donation_id')
                    );

                /*
                |--------------------------------------------------------------------------
                | Donation Amount is the source of truth
                |--------------------------------------------------------------------------
                */

                $payment = Payment::create([
                    'uuid' =>
                        (string) Str::uuid(),

                    'payment_no' =>
                        $this->generatePaymentNo(),

                    'donation_id' =>
                        $donation->id,

                    'payment_method' =>
                        $request->input(
                            'payment_method'
                        ),

                    'payment_gateway' =>
                        $request->input(
                            'payment_gateway'
                        ),

                    'transaction_id' =>
                        $request->input(
                            'transaction_id'
                        ),

                    'gateway_reference' =>
                        $request->input(
                            'gateway_reference'
                        ),

                    'amount' =>
                        $donation->amount,

                    'currency' =>
                        $donation->currency,

                    'status' =>
                        'initiated',

                    'initiated_at' =>
                        now(),

                    'payer_note' =>
                        $request->input(
                            'payer_note'
                        ),
                ]);

                return $payment;
            }
        );

        return new PaymentResource(
            $payment->load('donation')
        );
    }

    public function show(
        Payment $payment
    ): PaymentResource {

        return new PaymentResource(
            $payment->load('donation')
        );
    }

    public function update(
        UpdatePaymentRequest $request,
        Payment $payment
    ): PaymentResource {

        if ($payment->status === 'paid') {
            return response()->json([
                'message' =>
                    'A paid payment cannot be modified.',
            ], 422);
        }

        $payment->update(
            $request->validated()
        );

        return new PaymentResource(
            $payment->fresh()->load('donation')
        );
    }

    public function destroy(
        Payment $payment
    ): JsonResponse {

        if ($payment->status === 'paid') {
            return response()->json([
                'message' =>
                    'A paid payment cannot be deleted.',
            ], 422);
        }

        $payment->delete();

        return response()->json([
            'message' =>
                'Payment deleted successfully.',
        ]);
    }

    private function generatePaymentNo(): string
    {
        do {
            $number =
                'PAY-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(
                    Str::random(6)
                );

        } while (
            Payment::where(
                'payment_no',
                $number
            )->exists()
        );

        return $number;
    }

    public function confirm(
        Request $request,
        Payment $payment,
        PaymentConfirmationService $service
    ) {
        $payment = $service->confirm(
            $payment,
            auth()->id()
        );

        return new PaymentResource(
            $payment
        );
    }
}