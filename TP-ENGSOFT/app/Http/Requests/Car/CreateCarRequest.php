<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'license_plate' => 'required|string|max:7',
        ];
    }

    public function messages()
    {
        return [
            'brand.required' => 'O campo marca é obrigatório.',
            'brand.string' => 'O campo marca deve ser uma string.',
            'brand.max' => 'O campo marca não pode ter mais de :max caracteres.',
            
            'model.required' => 'O campo modelo é obrigatório.',
            'model.string' => 'O campo modelo deve ser uma string.',
            'model.max' => 'O campo modelo não pode ter mais de :max caracteres.',
            
            'color.required' => 'O campo cor é obrigatório.',
            'color.string' => 'O campo cor deve ser uma string.',
            'color.max' => 'O campo cor não pode ter mais de :max caracteres.',
            
            'license_plate.required' => 'O campo placa é obrigatório.',
            'license_plate.string' => 'O campo placa deve ser uma string.',
            'license_plate.max' => 'O campo placa não pode ter mais de :max caracteres.',
        ];
    }
}

