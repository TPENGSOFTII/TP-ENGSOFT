<?php

namespace App\Http\Controllers;

use App\Services\UserCarService;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Http\Request;

class UserCarController extends Controller
{
    protected $userCarService;

    public function __construct(UserCarService $userCarService)
    {
        $this->userCarService = $userCarService;
    }

    public function associateUserToCar($userId, $carId, Request $request)
    {
        try {
            $this->userCarService->associateUserToCar($userId, $carId);

            return response()->json(['message' => 'Usuário associado ao carro com sucesso.'], 200);
        }catch (EntityNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }
}