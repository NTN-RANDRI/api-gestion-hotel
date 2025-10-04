<?php

namespace App\Exceptions\Equipement;

use App\Exceptions\AppException;

class EquipementNotFoundException extends AppException
{
    protected int $statusCode = 404;

    public function __construct(string $message = "L'équipement avec l'ID fourni n'existe pas.")
    {
        parent::__construct($message, $this->statusCode);
    }

}
