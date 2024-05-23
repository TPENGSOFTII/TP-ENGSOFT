<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Exceptions\EntityNotFoundException;

use App\Services\UserService;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request)
    {
        try {
            $userData = $request->validated();

            $user = $this->userService->createUser($userData);

            return response()->json(['user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $userData = $request->validated();

            $user = $this->userService->updateUser($id, $userData);

            return response()->json(['user' => $user], 200);
        } catch (EntityNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $this->userService->deleteUser($id);

            return response()->json(['message' => 'Usuário deletado com sucesso.'], 200);
        } catch (EntityNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}

