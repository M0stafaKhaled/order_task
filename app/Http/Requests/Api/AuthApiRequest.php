<?php

namespace App\Http\Requests\Api;



use App\Http\Requests\helper\APIRequest;

class AuthApiRequest extends APIRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|',
            'password' => 'required|string',
        ];
    }
}
