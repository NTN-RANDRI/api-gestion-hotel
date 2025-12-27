<?php

namespace App\Application\DTOs\TypeChambre;

class TypeChambreOutputDTO
{

    /**
    //  * @param \App\Application\DTOs\Chambre\ChambreOutputDTO[] $chambres
     */
    public function __construct(
        public int $id,
        public string $nom,
        public int $nombreLits,
        public int $capaciteMax,
        public ?string $description,
        public ?int $totalChambres = null
    )
    {}

}