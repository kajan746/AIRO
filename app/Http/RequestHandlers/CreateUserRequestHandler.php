<?php
namespace App\Http\RequestHandlers;

use App\Http\RequestHandlers\CommonRequest;

class CreateUserRequestHandler extends CommonRequest
{
    public function rules()
    {
        return [
            'name'      => 'required',
            'email'     => 'required | email | max:255 | unique:users',
            'password'  => 'required | min:8',
        ];
    }

    public function messages()
    {
        $messages = [
            'name.required'     => 'Please enter your name.',
            'email.required'    => 'Please enter the email address.',
            'email.email'       => 'Please enter a valid email address.',
            'password.required' => 'Please enter the password.',
            'password.min'      => 'Your password should have at least 8 characters.'
        ];
        
        return $messages;
    }
}
