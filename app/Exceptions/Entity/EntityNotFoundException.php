<?php

namespace App\Exceptions\Entity;

use App\Exceptions\AppException;

class EntityNotFoundException extends AppException
{
    protected int $statusCode = 404;

    public function __construct(string $entityName = 'Entité', string $message = "")
    {
        $message = $message ?: sprintf("%s avec l'ID fourni n'existe pas.", $entityName);
        parent::__construct($message, $this->statusCode);
    }

}