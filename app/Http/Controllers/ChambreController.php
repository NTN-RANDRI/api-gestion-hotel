<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Chambre\AddImageToChambre;
use App\Application\UseCases\Chambre\CreateChambre;
use App\Application\UseCases\Chambre\DeleteChambre;
use App\Application\UseCases\Chambre\GetChambreById;
use App\Application\UseCases\Chambre\GetDisponibleChambres;
use App\Application\UseCases\Chambre\GetOccupeeChambres;
use App\Application\UseCases\Chambre\ListChambre;
use App\Application\UseCases\Chambre\ListMaintenancesChambre;
use App\Application\UseCases\Chambre\UpdateChambre;
use App\Http\Mappers\ChambreHttpMapper;
use App\Http\Requests\Chambre\AddImageChambreRequest;
use App\Http\Requests\Chambre\SearchDisponibleChambreRequest;
use App\Http\Requests\Chambre\SearchOccupeeChambreRequest;
use App\Http\Requests\Chambre\StoreChambreRequest;
use App\Http\Requests\Chambre\UpdateChambreRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class ChambreController extends Controller
{
    private const RESOURCE = 'Chambre';

    public function __construct(
        private ListChambre $listChambre,
        private GetChambreById $getChambreById,
        private CreateChambre $createChambre,
        private UpdateChambre $updateChambre,
        private DeleteChambre $deleteChambre,
        private GetDisponibleChambres $getDisponibleChambres,
        private GetOccupeeChambres $getOccupeeChambres,
        private AddImageToChambre $addImageToChambre,
        private ListMaintenancesChambre $listMaintenancesChambre,
    )
    {}

    public function index(): JsonResponse
    {
        $outputDTOs = $this->listChambre->execute();

        return ApiResponse::crudSuccess('list', self::RESOURCE, $outputDTOs);
    }

    public function show(int $id): JsonResponse
    {
        $outputDTO = $this->getChambreById->execute($id);

        return ApiResponse::crudSuccess('read', self::RESOURCE, $outputDTO);
    }

    public function store(StoreChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $inputDTO = ChambreHttpMapper::toDTO($validated);
        $outputDTO = $this->createChambre->execute($inputDTO, $validated['images']);

        return ApiResponse::crudSuccess('create', self::RESOURCE, $outputDTO);
    }

    public function update(int $id, UpdateChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $inputDTO = ChambreHttpMapper::toDTO($validated);
        $outputDTO = $this->updateChambre->execute($id, $inputDTO);

        return ApiResponse::crudSuccess('update', self::RESOURCE, $outputDTO);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteChambre->execute($id);

        return ApiResponse::crudSuccess('delete', self::RESOURCE);
    }

    public function disponibles(SearchDisponibleChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Récupération des dates depuis la requête
        $dateDebut = new \DateTime($validated['date_debut']);
        $dateFin = new \DateTime($validated['date_fin']);
        $reservationIdToIgnore = $validated['reservation_id_to_ignore'] ?? null;

        // Appel du use case
        $outputDTOs = $this->getDisponibleChambres->execute($dateDebut, $dateFin, $reservationIdToIgnore);

        return ApiResponse::crudSuccess('list', self::RESOURCE, $outputDTOs);
    }

    public function occupees(SearchOccupeeChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $dateDebut = new \DateTime($validated['date_debut']);
        $dateFin = new \DateTime($validated['date_fin']);

        $outputDTOs = $this->getOccupeeChambres->execute($dateDebut, $dateFin);

        return ApiResponse::crudSuccess('list', self::RESOURCE, $outputDTOs);
    }

    public function addImage(AddImageChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $imageOutput = $this->addImageToChambre->execute($validated['chambre_id'], $validated['image']);

        return ApiResponse::crudSuccess('create', 'Image', $imageOutput);
    }

    public function maintenances(int $id): JsonResponse
    {
        $outputDTOs = $this->listMaintenancesChambre->execute($id);

        return ApiResponse::crudSuccess('list', 'Maintenances', $outputDTOs);
    }

}
