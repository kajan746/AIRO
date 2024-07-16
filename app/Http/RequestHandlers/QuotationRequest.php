<?php

namespace App\Http\RequestHandlers;

use App\Http\RequestHandlers\CommonRequest;

class QuotationRequest extends CommonRequest
{
    public function rules()
    {
        return [
            'age'           => 'required',
            'currency_id'   => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
        ];
    }

    public function messages()
    {
        $messages = [
            'age.required'          => 'Please enter the ages.',
            'currency_id.required'  => 'Please select the currency.',
            'start_date.required'   => 'Please select the start date.',
            'end_date.required'     => 'Please select the start date.',
        ];

        return $messages;
    }
}
