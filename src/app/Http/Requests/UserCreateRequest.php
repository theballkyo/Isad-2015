<?php
namespace App\Http\Requests;

class UserCreateRequest extends Request
{

    public function rules()
    {
        return [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'id_card' => 'required|min:13|max:13',
            'password' => 'required|confirmed'
        ];
    }
}