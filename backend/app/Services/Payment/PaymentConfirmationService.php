<?php

namespace App\Services\Payment;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PaymentConfirmationService
{
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

            /*
            |--------------------------------------------------------------------------
            | Already Paid
            |--------------------------------------------------------------------------
            */

            if ($payment->status === 'paid') {
                return $payment;
            }

            /*
            |--------------------------------------------------------------------------
            | Failed Payment Cannot Be Confirmed
            |--------------------------------------------------------------------------
            */

            if ($payment->status === 'failed') {
                throw new RuntimeException(
                    'A failed payment cannot be confirmed.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Payment
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
            | Donation
            |--------------------------------------------------------------------------
            */

            $donation = $payment->donation;

            if ($donation->status !== 'completed') {

                $donation->update([
                    'status' => 'completed',
                    'donated_at' => now(),
                ]);
            }

            return $payment->fresh([
                'donation',
            ]);
        });
    }
}