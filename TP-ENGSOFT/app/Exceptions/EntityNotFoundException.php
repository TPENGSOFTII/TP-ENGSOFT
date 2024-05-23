<?php

namespace App\Exceptions;

use Exception;

class EntityNotFoundException extends Exception
{
    protected $entityName;

    public function __construct($entityName, $message = null, $code = 0, Exception $previous = null)
    {
        $this->entityName = $entityName;
        $message = $message ?: "Nenhum $entityName com esse ID foi encontrado.";

        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json(['error' => $this->getMessage()], 404);
    }
}
