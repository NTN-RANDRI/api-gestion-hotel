<?php

namespace App\Http\Controllers;

use App\Application\UseCases\TypeChambre\CreateTypeChambre;
use App\Application\UseCases\TypeChambre\DeleteTypeChambre;
use App\Application\UseCases\TypeChambre\GetTypeChambreById;
use App\Application\UseCases\TypeChambre\ListTypeChambre;
use App\Application\UseCases\TypeChambre\UpdateTypeChambre;
use App\Http\Mappers\TypeChambreHttpMapper;
use App\Http\Requests\TypeChambre\StoreTypeChambreRequest;
use App\Http\Requests\TypeChambre\UpdateTypeChambreRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class TypeChambreController extends Controller
{
    private const RESOURCE = 'TypeChambre';

    public function __construct(
        private ListTypeChambre $listTypeChambre,
        private GetTypeChambreById $getTypeChambreById,
        private CreateTypeChambre $createTypeChambre,
        private UpdateTypeChambre $updateTypeChambre,
        private DeleteTypeChambre $deleteTypeChambre
    )
    {}

    public function index(): JsonResponse
    {
        $outputDTOs = $this->listTypeChambre->execute();

        return ApiResponse::crudSuccess('list', self::RESOURCE, $outputDTOs);
    }

    public function show(int $id): JsonResponse
    {
        $outputDTO = $this->getTypeChambreById->execute($id);

        return ApiResponse::crudSuccess('read', self::RESOURCE, $outputDTO);
    }

    public function store(StoreTypeChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $inputDTO = TypeChambreHttpMapper::toDTO($validated);
        $outputDTO = $this->createTypeChambre->execute($inputDTO);

        return ApiResponse::crudSuccess('create', self::RESOURCE, $outputDTO);
    }

    public function update(int $id, UpdateTypeChambreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $inputDTO = TypeChambreHttpMapper::toDTO($validated);
        $outputDTO = $this->updateTypeChambre->execute($id, $inputDTO);

        return ApiResponse::crudSuccess('update', self::RESOURCE, $outputDTO);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteTypeChambre->execute($id);

        return ApiResponse::crudSuccess('delete', self::RESOURCE);
    }

}
