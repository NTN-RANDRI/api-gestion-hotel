<?php

namespace App\Exceptions\Equipement;

use App\Exceptions\AppException;

class EquipementNotFoundException extends AppException
{
    protected int $statusCode = 404;

    public function __construct(string $message = "Équipement introuvable.")
    {
        parent::__construct($message, $this->statusCode);
    }
    
}
