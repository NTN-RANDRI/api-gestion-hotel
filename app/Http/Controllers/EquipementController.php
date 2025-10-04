<?php

namespace App\Http\Controllers;

use App\Application\DTOs\Equipement\EquipementInputDTO;
use App\Application\UseCases\Equipement\CreateEquipement;
use App\Application\UseCases\Equipement\DeleteEquipement;
use App\Application\UseCases\Equipement\GetEquipementById;
use App\Application\UseCases\Equipement\ListEquipements;
use App\Application\UseCases\Equipement\UpdateEquipement;
use App\Http\Requests\Equipement\StoreEquipementRequest;
use App\Http\Requests\Equipement\UpdateEquipementRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class EquipementController extends Controller
{
    private const RESOURCE = 'Équipement';

    public function __construct(
        private ListEquipements $listEquipements,
        private GetEquipementById $getEquipementById,
        private CreateEquipement $createEquipement,
        private UpdateEquipement $updateEquipement,
        private DeleteEquipement $deleteEquipement
    )
    {}

    public function index(): JsonResponse
    {
        $equipements = $this->listEquipements->execute();

        return ApiResponse::crudSuccess('list', self::RESOURCE, $equipements);
    }

    public function show(int $id): JsonResponse
    {
        $outputDTO = $this->getEquipementById->execute($id);

        return ApiResponse::crudSuccess('read', self::RESOURCE, $outputDTO);

    }

    public function store(StoreEquipementRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $inputDTO = new EquipementInputDTO(
            nom: $validated['nom'],
            description: $validated['description'] ?? null
        );

        $outputDTO = $this->createEquipement->execute($inputDTO);

        return ApiResponse::crudSuccess('create', self::RESOURCE, $outputDTO);
    }

    public function update(int $id, UpdateEquipementRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $inputDTO = new EquipementInputDTO(
            nom: $validated['nom'],
            description: $validated['description']
        );

        $outputDTO = $this->updateEquipement->execute($id, $inputDTO);

        return ApiResponse::crudSuccess('update', self::RESOURCE, $outputDTO);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteEquipement->execute($id);

        return ApiResponse::crudSuccess('create', self::RESOURCE);
    }

}
