<?php

namespace App\Http\Requests;

use App\Http\Requests\helper\APIRequest;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductApiRequest extends APIRequest
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
       return Product::$rules;
    }
}
