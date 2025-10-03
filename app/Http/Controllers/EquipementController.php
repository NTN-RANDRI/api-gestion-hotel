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
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EquipementController extends Controller
{

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

        return response()->json($equipements);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $outputDTO = $this->getEquipementById->execute($id);

            return response()->json($outputDTO);
        } catch (\Exception $e) {
            // return response()->json(['message' => $e->getMessage()], 404);
            throw $e;
        }

    }

    public function store(StoreEquipementRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $inputDTO = new EquipementInputDTO(
            nom: $validated['nom'],
            description: $validated['description'] ?? null
        );

        $outputDTO = $this->createEquipement->execute($inputDTO);

        return response()->json($outputDTO);
    }

    public function update(int $id, UpdateEquipementRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $inputDTO = new EquipementInputDTO(
            nom: $validated['nom'],
            description: $validated['description']
        );

        try {
            $outputDTO = $this->updateEquipement->execute($id, $inputDTO);

            return response()->json($outputDTO);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }


    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->deleteEquipement->execute($id);

            return response()->json(['message' => "Equipement supprimer"]);
        } catch (NotFoundHttpException $e) {
            // return response()->json(['message' => $e->getMessage()], 404);
            throw $e;
        }

    }

}
