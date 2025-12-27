<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Client\CreateClient;
use App\Application\UseCases\Client\DeleteClient;
use App\Application\UseCases\Client\GetClientById;
use App\Application\UseCases\Client\ListClients;
use App\Application\UseCases\Client\UpdateClient;
use App\Http\Mappers\ClientHttpMapper;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private const RESSOURCE = 'Client';

    public function __construct(
        private ListClients $listClients,
        private GetClientById $getClientById,
        private CreateClient $createClient,
        private UpdateClient $updateClient,
        private DeleteClient $deleteClient
    )
    {}

    public function index(): JsonResponse
    {
        $clientOutputs = $this->listClients->execute();

        return ApiResponse::crudSuccess('list', self::RESSOURCE, $clientOutputs);
    }

    public function show(int $id): JsonResponse
    {
        $clientOutput = $this->getClientById->execute($id);

        return ApiResponse::crudSuccess('read', self::RESSOURCE, $clientOutput);
    }

    // public function store(StoreClientRequest $request): JsonResponse
    // {
    //     $validated = $request->validated();
    //     $clientInput = ClientHttpMapper::toDTO($validated);
    //     $clientOutput = $this->createClient->execute($clientInput);

    //     return ApiResponse::crudSuccess('create', self::RESSOURCE, $clientOutput);
    // }

    public function update(UpdateClientRequest $request): JsonResponse
    {
        $validated = $request->validated();

        dd(auth()->id());

        $clientInput = ClientHttpMapper::toDTO($validated);
        $email = $validated['email'];

        // $clientOutput = $this->updateClient->execute($id, $clientInput, $email);

        return ApiResponse::crudSuccess('update', self::RESSOURCE, $clientOutput);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteClient->execute($id);
        
        return ApiResponse::crudSuccess('delete', self::RESSOURCE);
    }

}
