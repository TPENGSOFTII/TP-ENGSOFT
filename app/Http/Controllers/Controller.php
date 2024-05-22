<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function formatValidationErrors(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return response()->json(['error' => $validator->errors()], 422);
    }
}
