<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Personnel\CreatePersonnel;
use App\Application\UseCases\Personnel\DeletePersonnel;
use App\Application\UseCases\Personnel\GetPersonnelById;
use App\Application\UseCases\Personnel\ListPersonnels;
use App\Application\UseCases\Personnel\UpdatePersonnel;
use App\Http\Mappers\PersonnelHttpMapper;
use App\Http\Requests\Personnel\StorePersonnelRequest;
use App\Http\Requests\Personnel\UpdatePersonnelRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    
    private const RESSOURCE = 'Personnel';

    public function __construct(
        private ListPersonnels $listPersonnels,
        private GetPersonnelById $getPersonnelById,
        private CreatePersonnel $createPersonnel,
        private UpdatePersonnel $updatePersonnel,
        private DeletePersonnel $deletePersonnel,
    )
    {}

    public function index(): JsonResponse
    {
        $personnelOutputs = $this->listPersonnels->execute();

        return ApiResponse::crudSuccess('list', self::RESSOURCE, $personnelOutputs);
    }

    public function show(int $id): JsonResponse
    {
        $personnelOutput = $this->getPersonnelById->execute($id);

        return ApiResponse::crudSuccess('read', self::RESSOURCE, $personnelOutput);
    }

    public function store(StorePersonnelRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $personnelInput = PersonnelHttpMapper::toDTO($validated);
        $personnelOutput = $this->createPersonnel->execute($personnelInput);

        return ApiResponse::crudSuccess('create', self::RESSOURCE, $personnelOutput);
    }

    public function update(int $id, UpdatePersonnelRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $personnelInput = PersonnelHttpMapper::toDTO($validated);
        $personnelOutput = $this->updatePersonnel->execute($id, $personnelInput);

        return ApiResponse::crudSuccess('update', self::RESSOURCE, $personnelOutput);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deletePersonnel->execute($id);
        
        return ApiResponse::crudSuccess('delete', self::RESSOURCE);
    }

}
