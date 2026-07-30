<?php

namespace App\Services\Receipt;

use App\Models\Donation;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class ReceiptService
{
    public function createForDonation(
        Donation $donation,
        ?int $createdBy = null
    ): Receipt {

        return DB::transaction(function () use (
            $donation,
            $createdBy
        ) {

            /*
            |--------------------------------------------------------------------------
            | Donation must be completed
            |--------------------------------------------------------------------------
            */

            if ($donation->status !== 'completed') {
                throw new RuntimeException(
                    'Receipt can only be generated for a completed donation.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Existing Receipt
            |--------------------------------------------------------------------------
            */

            $existingReceipt = Receipt::where(
                'donation_id',
                $donation->id
            )->first();

            if ($existingReceipt) {
                return $existingReceipt;
            }

            /*
            |--------------------------------------------------------------------------
            | Completed Payment
            |--------------------------------------------------------------------------
            */

            $payment = $donation->payments()
                ->where('status', 'paid')
                ->latest('paid_at')
                ->first();

            if (!$payment) {
                throw new RuntimeException(
                    'No successful payment was found for this donation.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Create Receipt
            |--------------------------------------------------------------------------
            */

            return Receipt::create([
                'uuid' => (string) Str::uuid(),

                'receipt_no' =>
                    $this->generateReceiptNo(),

                'donation_id' =>
                    $donation->id,

                'payment_id' =>
                    $payment->id,

                'amount' =>
                    $donation->amount,

                'currency' =>
                    $donation->currency,

                'issued_at' =>
                    now(),

                'is_verified' =>
                    true,

                'created_by' =>
                    $createdBy,
            ]);
        });
    }

    private function generateReceiptNo(): string
    {
        do {
            $number =
                'RCT-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(
                    Str::random(6)
                );

        } while (
            Receipt::where(
                'receipt_no',
                $number
            )->exists()
        );

        return $number;
    }
}