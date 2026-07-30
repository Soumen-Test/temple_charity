<?php

namespace App\Http\Resources\Api\V1\Receipt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceiptResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' =>
                $this->id,

            'uuid' =>
                $this->uuid,

            'receipt_no' =>
                $this->receipt_no,

            'donation_id' =>
                $this->donation_id,

            'payment_id' =>
                $this->payment_id,

            'amount' =>
                $this->amount,

            'currency' =>
                $this->currency,

            'issued_at' =>
                $this->issued_at,

            'pdf_path' =>
                $this->pdf_path,

            'email_sent_at' =>
                $this->email_sent_at,

            'sms_sent_at' =>
                $this->sms_sent_at,

            'is_verified' =>
                $this->is_verified,

            'created_at' =>
                $this->created_at,
        ];
    }
}