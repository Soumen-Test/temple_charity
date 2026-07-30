<?php

namespace App\Http\Resources\Api\V1\Ledger;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LedgerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->date,
            'type' => $this->type,
            'reference_no' => $this->reference_no,
            'description' => $this->description,
            'income' => $this->income,
            'expense' => $this->expense,
            'balance' => $this->balance,
            'currency' => $this->currency,
        ];
    }
}