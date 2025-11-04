<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Client;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\ClientModelMapper;
use App\Models\Client as ClientModel;

class ClientRepository implements ClientRepositoryInterface
{

	public function all(): array
	{
		$clientCollection = ClientModel::all();
		$clients = $clientCollection->map(
			fn ($clientModel) => ClientModelMapper::toDomain($clientModel)
		)->all();

		return $clients;
	}

	public function find(int $id): ?Client
	{
		$clientModel = ClientModel::find($id);

		return $clientModel ? ClientModelMapper::toDomain($clientModel) : null;
	}

	public function save(Client $client): Client
	{
		$id = $client->getId();

		if ($id) {
			$clientModel = ClientModel::find($id);
			$clientModel->update(ClientModelMapper::toArray($client));
		} else {
			$clientModel = ClientModel::create(ClientModelMapper::toArray($client));
		}

		return ClientModelMapper::toDomain($clientModel);
	}

	public function delete(int $id): void
	{
		$clientModel = ClientModel::find($id);
		$clientModel->delete();
	}


}