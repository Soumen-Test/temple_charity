<?php

namespace App\Http\Resources\Api\V1\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'uuid' => $this->uuid,

            'payment_no' => $this->payment_no,

            'donation' => $this->whenLoaded(
                'donation',
                function () {
                    return [
                        'id' => $this->donation->id,
                        'uuid' => $this->donation->uuid,
                        'donation_no' =>
                            $this->donation->donation_no,
                        'amount' =>
                            $this->donation->amount,
                        'status' =>
                            $this->donation->status,
                    ];
                }
            ),

            'payment_method' =>
                $this->payment_method,

            'payment_gateway' =>
                $this->payment_gateway,

            'transaction_id' =>
                $this->transaction_id,

            'gateway_reference' =>
                $this->gateway_reference,

            'amount' =>
                $this->amount,

            'currency' =>
                $this->currency,

            'status' =>
                $this->status,

            'initiated_at' =>
                $this->initiated_at,

            'paid_at' =>
                $this->paid_at,

            'failed_at' =>
                $this->failed_at,

            'payer_note' =>
                $this->payer_note,

            'verified_by' =>
                $this->verified_by,

            'verified_at' =>
                $this->verified_at,

            'created_at' =>
                $this->created_at,

            'updated_at' =>
                $this->updated_at,
        ];
    }
}