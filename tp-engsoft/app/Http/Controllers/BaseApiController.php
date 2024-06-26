<?php

namespace App\Http\Controllers;

use App\Exceptions\EntityNotFoundException;

class BaseApiController extends Controller
{
    protected function jsonResponse($data, int $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }

    protected function handleException(\Exception $e, int $statusCode = 500)
    {
        return $this->jsonResponse(['error' => $e->getMessage()], $statusCode);
    }

    protected function handleEntityNotFoundException(\Exception $e)
    {
        return $this->jsonResponse(['error' => $e->getMessage()], 404);
    }

    protected function handleCreate($data, callable $serviceMethod, int $successStatus = 201)
    {
        try {
            $result = call_user_func($serviceMethod, $data);
            return $this->jsonResponse($result, $successStatus);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    protected function handleUpdate(int $id, $data, callable $serviceMethod)
    {
        try {
            $result = call_user_func($serviceMethod, $id, $data);
            return $this->jsonResponse($result, 200);
        } catch (EntityNotFoundException $e) {
            return $this->handleEntityNotFoundException($e);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    protected function handleDelete(int $id, callable $serviceMethod, string $entity)
    {
        try {
            call_user_func($serviceMethod, $id);
            return $this->jsonResponse(['message' => "$entity deletado com sucesso."], 200);
        } catch (EntityNotFoundException $e) {
            return $this->handleEntityNotFoundException($e);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
    protected function handleGetAll(callable $serviceMethod, $id = null)
    {
        try {
            $result = $id !== null ? call_user_func($serviceMethod, $id) : call_user_func($serviceMethod);
            return $this->jsonResponse($result, 200);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    protected function handleAssociationOrDisassociation(int $userId, int $carId, callable $serviceMethod, bool $isAssociation)
    {
        try {
            $sucessMessage = $isAssociation ? 'Usuário associado ao carro com sucesso.' : 'Usuário desassociado do carro com sucesso.';
            call_user_func($serviceMethod, $userId, $carId);
            return $this->jsonResponse(['message' => $sucessMessage], 200);
        } catch (EntityNotFoundException $e) {
            return $this->handleEntityNotFoundException($e);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
