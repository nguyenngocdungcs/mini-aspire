<?php

namespace App\Http\Requests;

use App\Loan;
use Illuminate\Foundation\Http\FormRequest;

class LoanCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $RFOptions = [
            Loan::REPAYMENT_FREQUENCY_MONTHLY,
            Loan::REPAYMENT_FREQUENCY_FORTNIGHTLY,
            Loan::REPAYMENT_FREQUENCY_WEEKLY,
        ];

        return [
            'user_id' => 'required|exists:users,id',
            'amount' => "required|numeric",
            'interest_rate' => "required|numeric|gte:0|lte:1",
            'arrangement_fee' => "required|numeric",
            'repayment_frequency' => 'required|in:' .implode(",", $RFOptions),
            'repayment_times' => 'required|numeric',
        ];
    }
}
