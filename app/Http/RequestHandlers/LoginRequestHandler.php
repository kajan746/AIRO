<?php
namespace App\Http\RequestHandlers;

use Request;
use App\Http\RequestHandlers\CommonRequest;

class LoginRequestHandler extends CommonRequest
{
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'email'     => 'required | email',
            'password'  => 'required',
        ];
    }

    public function messages()
    {
        $messages = [
            'email.required'    => 'Please enter the email address.',
            'email.email'       => 'Please enter a valid email address.',
            'password.required' => 'Please enter the password.'
        ];
        
        return $messages;
    }
}
