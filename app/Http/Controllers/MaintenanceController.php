<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Maintenance\CreateMaintenance;
use App\Application\UseCases\Maintenance\DeleteMaintenance;
use App\Application\UseCases\Maintenance\GetMaintenanceById;
use App\Application\UseCases\Maintenance\ListMaintenance;
use App\Application\UseCases\Maintenance\MarkFinMaintenance;
use App\Application\UseCases\Maintenance\UpdateMaintenance;
use App\Http\Mappers\MaintenanceHttpMapper;
use App\Http\Requests\Maintenance\StoreMaintenanceRequest;
use App\Http\Requests\Maintenance\UpdateMaintenanceRequest;
use App\Http\Responses\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class MaintenanceController extends Controller
{
    private const RESSOURCE = 'Maintenance';
    
    public function __construct(
        private ListMaintenance $listMaintenance,
        private GetMaintenanceById $getMaintenaneById,
        private CreateMaintenance $createMaintenance,
        private UpdateMaintenance $updateMaintenance,
        private DeleteMaintenance $deleteMaintenance,
        private MarkFinMaintenance $markFinMaintenance,
    )
    {}

    public function index(): JsonResponse
    {
        $maintenanceOutputs = $this->listMaintenance->execute();

        return ApiResponse::crudSuccess('list', self::RESSOURCE, $maintenanceOutputs);
    }

    public function show(int $id): JsonResponse
    {
        $maintenanceOutput = $this->getMaintenaneById->execute($id);

        return ApiResponse::crudSuccess('read', self::RESSOURCE, $maintenanceOutput);
    }

    public function store(StoreMaintenanceRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $maintenanceInput = MaintenanceHttpMapper::toDTO($validated);
        $maintenanceOutput = $this->createMaintenance->execute($maintenanceInput);

        return ApiResponse::crudSuccess('create', self::RESSOURCE, $maintenanceOutput);
    }

    public function update(int $id, UpdateMaintenanceRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $maintenanceInput = MaintenanceHttpMapper::toUpdateDTO($validated);
        $maintenanceOutput = $this->updateMaintenance->execute($id, $maintenanceInput);

        return ApiResponse::crudSuccess('update', self::RESSOURCE, $maintenanceOutput);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteMaintenance->execute($id);

        return ApiResponse::crudSuccess('delete', self::RESSOURCE);
    }

    public function fin(int $id): JsonResponse
    {
        $maintenanceOutput = $this->markFinMaintenance->execute($id);

        return ApiResponse::crudSuccess('update', self::RESSOURCE, $maintenanceOutput);
    }

}
