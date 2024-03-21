<?php

namespace App\Http\Requests\helper;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class APIRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Default to true if not needing authorization, otherwise implement logic.
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
     * This method should be overridden in the child request class.
     *
     * @return array
     */
    public function rules()
    {
        // Specify validation rules in the child class.
        return [];
    }

    /**
     * Handle a failed validation attempt.
     *
     * Overriding this method to throw an exception allows us to customize the response format.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        // Combine all error messages into a single string.
        $message = implode(' ', $errors);

        // Throw an HttpResponseException with a custom response.
        throw new HttpResponseException($this->apiErrorResponse($message, 422));
    }

    /**
     * Create a JSON response for API errors.
     *
     * This method allows for consistent error formatting across the application.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function apiErrorResponse($message, $statusCode)
    {
        // Format the error response structure as desired.
        $response = [
            'success' => false,
            'message' => $message,
        ];

        // Return a JsonResponse with the formatted array and status code.
        return response()->json($response, $statusCode);
    }
}
