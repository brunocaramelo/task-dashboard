<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class TaskCreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'rapporteur_id' => ['required'],
            'responsible_id' => ['required'],
            'status_id' => ['required'],
            'description' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'fail',
            'message' => 'Input fail',
            'errors' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
