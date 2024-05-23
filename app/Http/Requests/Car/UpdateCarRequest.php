<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'brand' => 'sometimes|string|max:255',
            'model' => 'sometimes|string|max:255',
            'color' => 'sometimes|string|max:50',
            'license_plate' => 'sometimes|string|max:7',
        ];
    }

    public function messages()
    {
        return [
            'brand.string' => 'O campo marca deve ser uma string.',
            'brand.max' => 'O campo marca não pode ter mais de :max caracteres.',
            
            'model.string' => 'O campo modelo deve ser uma string.',
            'model.max' => 'O campo modelo não pode ter mais de :max caracteres.',
            
            'color.string' => 'O campo cor deve ser uma string.',
            'color.max' => 'O campo cor não pode ter mais de :max caracteres.',
            
            'license_plate.string' => 'O campo placa deve ser uma string.',
            'license_plate.max' => 'O campo placa não pode ter mais de :max caracteres.',
        ];
    }
}
