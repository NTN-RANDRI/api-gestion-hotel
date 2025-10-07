<?php

namespace App\Http\Controllers;

use App\Application\Mappers\ChambreRequestMapper;
use App\Application\UseCases\Chambre\CreateChambre;
use App\Application\UseCases\Chambre\DeleteChambre;
use App\Application\UseCases\Chambre\GetChambreById;
use App\Application\UseCases\Chambre\ListChambre;
use App\Application\UseCases\Chambre\UpdateChambre;
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
        private DeleteChambre $deleteChambre
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
        $inputDTO = ChambreRequestMapper::fromRequest($validated);
        $outputDTO = $this->createChambre->execute($inputDTO);

        return ApiResponse::crudSuccess('create', self::RESOURCE, $outputDTO);
    }

    public function update(int $id, UpdateChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $inputDTO = ChambreRequestMapper::fromRequest($validated);
        $outputDTO = $this->updateChambre->execute($id, $inputDTO);

        return ApiResponse::crudSuccess('update', self::RESOURCE, $outputDTO);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteChambre->execute($id);

        return ApiResponse::crudSuccess('delete', self::RESOURCE);
    }

}
