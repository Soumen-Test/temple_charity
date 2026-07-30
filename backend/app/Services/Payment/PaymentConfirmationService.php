<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Services\Receipt\ReceiptService;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PaymentConfirmationService
{
    public function __construct(
        private ReceiptService $receiptService
    ) {
    }

    public function confirm(
        Payment $payment,
        ?int $verifiedBy = null
    ): Payment {

        return DB::transaction(function () use (
            $payment,
            $verifiedBy
        ) {

            $payment = Payment::query()
                ->lockForUpdate()
                ->with('donation')
                ->findOrFail($payment->id);

            if ($payment->status === 'paid') {
                return $payment;
            }

            if ($payment->status === 'failed') {
                throw new RuntimeException(
                    'A failed payment cannot be confirmed.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Mark Payment Paid
            |--------------------------------------------------------------------------
            */

            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
                'verified_by' => $verifiedBy,
                'verified_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Complete Donation
            |--------------------------------------------------------------------------
            */

            $donation = $payment->donation;

            $donation->update([
                'status' => 'completed',
                'donated_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Generate Receipt
            |--------------------------------------------------------------------------
            */

            $this->receiptService->createForDonation(
                $donation->fresh(),
                $verifiedBy
            );

            return $payment->fresh([
                'donation',
                'receipt',
            ]);
        });
    }
}