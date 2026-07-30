<?php

namespace App\Http\Requests\Api\V1\Payment;

use App\Models\Donation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donation_id' => [
                'required',
                'integer',
                'exists:donations,id',
            ],

            'payment_method' => [
                'required',
                'string',
                'max:50',
                'in:bkash,nagad,rocket,bank_transfer,visa,mastercard,stripe,paypal',
            ],

            'payment_gateway' => [
                'nullable',
                'string',
                'max:100',
            ],

            'transaction_id' => [
                'nullable',
                'string',
                'max:200',
            ],

            'gateway_reference' => [
                'nullable',
                'string',
                'max:200',
            ],

            'payer_note' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {

                $donationId = $this->input('donation_id');

                if (!$donationId) {
                    return;
                }

                $donation = Donation::find($donationId);

                if (!$donation) {
                    return;
                }

                if ($donation->status === 'completed') {
                    $validator->errors()->add(
                        'donation_id',
                        'A completed donation cannot receive a new payment.'
                    );
                }
            },
        ];
    }
}